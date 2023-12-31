<?php

use WPML\FP\Obj;

abstract class WPML_Translation_Job extends WPML_Translation_Job_Helper {
	protected $basic_data;
	protected $element_id = - 1;
	protected $status     = - 1;
	protected $job_id;
	protected $batch_id;

	/** @var  WPML_TM_Blog_Translators $blog_translators */
	protected $blog_translators;

	/**
	 * @param  int                      $job_id
	 * @param int|null                 $batch_id
	 * @param WPML_TM_Blog_Translators $blog_translators
	 */
	function __construct( $job_id, $batch_id = null, &$blog_translators = null ) {
		$this->job_id           = $job_id;
		$batch_id               = $batch_id ? $batch_id : $this->get_batch_id();
		$this->batch_id         = $batch_id ? $batch_id : TranslationProxy_Batch::update_translation_batch();
		$this->blog_translators = $blog_translators ? $blog_translators : wpml_tm_load_blog_translators();
	}

	abstract public function cancel();

	abstract public function get_original_element_id();

	abstract public function to_array();

	/**
	 * @return string
	 */
	abstract function get_title();

	public function get_status() {
		if ( $this->status == - 1 ) {
			$this->status = $this->load_status();
		}

		return $this->status;
	}

	public function get_status_value() {
		$this->maybe_load_basic_data();

		return $this->basic_data->status;
	}

	public function get_review_status() {
		$this->maybe_load_basic_data();

		return $this->basic_data->review_status;
	}

	public function get_id() {
		return $this->job_id;
	}

	public function get_resultant_element_id( $force = false ) {
		if ( $this->element_id == - 1 || $force === true ) {
			$this->element_id = $this->load_resultant_element_id();
		}

		return $this->element_id;
	}

	/**
	 * Checks whether the input user is allowed to edit this job
	 *
	 * @param WP_User $user
	 *
	 * @return bool
	 */
	public function user_can_translate( $user ) {
		$translator_id          = $this->get_translator_id();
		$user_can_take_this_job = 0 === $translator_id
								|| $this->is_current_user_allowed_to_translate(
									$user,
									$translator_id
								);

		$translator_has_job_language_pairs = $this->blog_translators->is_translator(
			$user->ID,
			$this->filter_is_translator_args( [
				'lang_from' => $this->get_source_language_code(),
				'lang_to'   => $this->get_language_code(),
			] )
		);

		$user_can_translate = ( $user_can_take_this_job && $translator_has_job_language_pairs )
							  || user_can( $user, 'manage_options' );
		return apply_filters( 'wpml_user_can_translate', $user_can_translate, $user );
	}

	/**
	 * @param array $args
	 *
	 * @return array
	 */
	protected function filter_is_translator_args( array $args ) {
		return $args;
	}

	/**
	 * @param WP_User $user
	 * @param int     $translator_id
	 *
	 * @return bool
	 */
	private function is_current_user_allowed_to_translate( WP_User $user, $translator_id ) {
		$allowed_translators   = apply_filters( 'wpml_tm_allowed_translators_for_job', array(), $this );
		$allowed_translators[] = $translator_id;

		return in_array( (int) $user->ID, $allowed_translators, true );
	}

	public function get_batch_id() {
		if ( ! isset( $this->batch_id ) ) {
			$this->load_batch_id();
		}

		return $this->batch_id;
	}

	/**
	 * @param bool|false $as_name if true will return the language's display name if applicable
	 *
	 * @return bool|string
	 */
	public function get_language_code( $as_name = false ) {
		$this->maybe_load_basic_data();
		$code = isset( $this->basic_data->language_code ) ? $this->basic_data->language_code : false;

		return $code && $as_name ? $this->lang_code_to_name( $code ) : $code;
	}

	/**
	 * @param bool|false $as_name if true will return the language's display name if applicable
	 *
	 * @return bool|string
	 */
	function get_source_language_code( $as_name = false ) {
		$this->maybe_load_basic_data();
		$code = isset( $this->basic_data->source_language_code ) ? $this->basic_data->source_language_code : false;

		return $code && $as_name ? $this->lang_code_to_name( $code ) : $code;
	}

	/**
	 * @return string|false
	 */
	public function get_translator_name() {
		$this->maybe_load_basic_data();
		if ( Obj::prop( 'translation_service', $this->basic_data ) == TranslationProxy::get_current_service_id() ) {
			$this->basic_data->translator_name = TranslationProxy_Translator::get_translator_name( Obj::prop('translator_id', $this->basic_data) );
		} else {
			$this->basic_data->translator_name = false;
		}

		return $this->basic_data->translator_name;
	}

	/**
	 * Returns the id of the assigned translator or 0 if no translator is assigned to the job
	 *
	 * @return int
	 */
	public function get_translator_id() {
		$this->maybe_load_basic_data();

		$this->basic_data->translator_id = ! empty( $this->basic_data->translator_id )
			? $this->basic_data->translator_id : 0;

		return (int) $this->basic_data->translator_id;
	}

	public function get_basic_data() {
		$this->maybe_load_basic_data();

		return $this->basic_data;
	}

	/**
	 * @param  int    $translator_id
	 * @param string $service
	 *
	 * @return bool true on success false on failure
	 */
	public function assign_to( $translator_id, $service = 'local' ) {
		$this->maybe_load_basic_data();
		$prev_translator_id = $this->get_translator_id();
		$prev_service       = $this->get_translation_service();
		if ( $translator_id == $prev_translator_id && $service = $this->get_translation_service() ) {

			return true;
		}
		$this->basic_data->translator_id       = $translator_id;
		$this->basic_data->translation_service = $service;

		if ( $this->save_updated_assignment() === false ) {
			$this->basic_data->translator_id       = $prev_translator_id;
			$this->basic_data->translation_service = $prev_service;

			return false;
		}

		$job_id = $this->get_id();
		if ( $this->get_tm_setting( array( 'notification', 'resigned' ) ) == ICL_TM_NOTIFICATION_IMMEDIATELY
			 && ! empty( $prev_translator_id )
			 && $prev_translator_id != $translator_id
			 && $job_id ) {
			do_action( 'wpml_tm_remove_job_notification', $prev_translator_id, $this );
		}

		if ( $this->get_tm_setting( array( 'notification', 'new-job' ) ) == ICL_TM_NOTIFICATION_IMMEDIATELY ) {
			if ( empty( $translator_id ) ) {
				do_action( 'wpml_tm_new_job_notification', $this );
			} else {
				do_action( 'wpml_tm_assign_job_notification', $this, $translator_id );
			}
		}

		return true;
	}

	/**
	 * Returns either the translation service id for the job or 'local' for local jobs
	 *
	 * @return int|string
	 */
	public function get_translation_service() {
		$this->maybe_load_basic_data();
		$this->basic_data->translation_service = ! empty( $this->basic_data->translation_service )
			? $this->basic_data->translation_service : 'local';

		return $this->basic_data->translation_service;
	}

	abstract protected function save_updated_assignment();

	abstract protected function load_resultant_element_id();

	abstract protected function load_status();

	abstract protected function load_job_data( $id );

	abstract function get_type();

	protected function basic_data_to_array( $job_data ) {
		$this->maybe_load_basic_data();
		$data_array = (array) $job_data;
		if ( isset( $data_array['post_title'] ) ) {
			$data_array['post_title'] = esc_html( $data_array['post_title'] );
		}
		$data_array['translator_name']      = $this->get_translator_name();
		$data_array['batch_id']             = Obj::prop('batch_id', $job_data);
		$data_array['source_language_code'] = Obj::prop('source_language_code', $this->basic_data);
		$data_array['language_code']        = Obj::prop('language_code', $this->basic_data);
		$data_array['translator_html']      = $this->get_translator_html( $this->basic_data );
		$data_array['type']                 = $this->get_type();
		$data_array['lang_text']            = $this->generate_lang_text();

		return $data_array;
	}

	protected function maybe_load_basic_data() {
		if ( ! $this->basic_data ) {
			$this->basic_data = $this->load_job_data( $this->job_id );
			$this->basic_data = $this->basic_data ? $this->basic_data : new stdClass();
		}
	}

	private function get_inactive_translation_service( $translation_service_id ) {
		$cache_key   = $translation_service_id;
		$cache_group = 'get_inactive_translation_service';
		$cache_found = false;

		$service = wp_cache_get( $cache_key, $cache_group, false, $cache_found );

		if ( ! $cache_found ) {
			try {
				$service = TranslationProxy_Service::get_service( $translation_service_id );
			} catch ( WPMLTranslationProxyApiException $ex ) {
				$service = false;
			}
			if ( ! $service ) {
				$service       = new stdClass();
				$service->name = __( '(inactive and unknown service)', 'wpml-translation-management' );
			}
			wp_cache_set( $cache_key, $service, $cache_group );
		}

		return $service;
	}

	protected function get_translator_html( $job ) {

		$job                  = (object) $job;
		$current_service_name = TranslationProxy::get_current_service_name();
		$translation_services = array( 'local', TranslationProxy::get_current_service_id() );

		if ( isset( $job->translation_service ) && ! in_array( $job->translation_service, $translation_services ) ) {
			$inactive_service     = $this->get_inactive_translation_service( $job->translation_service );
			$current_service_name = $inactive_service->name;
		}
		$translator = '';

		if ( Obj::prop( 'translation_service', $job ) !== 'local' ) {
			try {
				$project = TranslationProxy::get_current_project();
				if ( $project ) {
					$translator .= $current_service_name;
				} else {
					$translator .= esc_html( $job->translator_name );
				}
			} catch ( Exception $e ) {
				// Just doesn't create the output
			}
		} elseif ( $job->status == ICL_TM_COMPLETE ) {
			$translator_data = get_userdata( $job->translator_id );
			$translator_name = $translator_data ? $translator_data->display_name : '';
			$translator      = '<span class="icl-finished-local-name">' . $translator_name . '</span>';
		} else {
			$translator         .= '<span class="icl_tj_select_translator">';
			$selected_translator = isset( $job->translator_id ) ? $job->translator_id : false;
			$disabled            = false;
			if ( $job->translation_service
				 && $job->translation_service !== 'local'
				 && is_numeric( $job->translation_service ) ) {
				$selected_translator = TranslationProxy_Service::get_wpml_translator_id(
					$job->translation_service,
					$job->translator_id
				);
				$disabled            = true;
			}

			$job_id     = isset( $job->job_id ) ? $job->job_id : $job->id;
			$local_only = isset( $job->local_only ) ? $job->local_only : true;
			$args       = array(
				'id'         => 'icl_tj_translator_for_' . $job_id,
				'name'       => 'icl_tj_translator_for_' . ( $job_id ),
				'from'       => $job->source_language_code,
				'to'         => $job->language_code,
				'selected'   => $selected_translator,
				'services'   => $translation_services,
				'disabled'   => $disabled,
				'echo'       => false,
				'local_only' => $local_only,
			);

			$translator .= wpml_tm_get_translators_dropdown()->render( $args );
			$translator .= '<input type="hidden" id="icl_tj_ov_'
						   . $job_id
						   . '" value="'
						   . (int) $job->translator_id
						   . '" />';
			$translator .= '<input type="hidden" id="icl_tj_ty_'
						   . $job_id
						   . '" value="'
						   . strtolower( $this->get_type() )
						   . '" />';
			$translator .= '<span class="icl_tj_select_translator_controls" id="icl_tj_tc_' . ( $job_id ) . '">';
			$translator .= '<input type="button" class="button-secondary icl_tj_ok" value="'
						. __(
							'Send',
							'wpml-translation-management'
						)
						   . '" />&nbsp;';
			$translator .= '<input type="button" class="button-secondary icl_tj_cancel" value="'
						. __(
							'Cancel',
							'wpml-translation-management'
						)
						   . '" />';
			$translator .= '</span>';
		}

		return $translator;
	}

	/**
	 * Retrieves the batch ID associated to the job ID
	 */
	abstract protected function load_batch_id();

	/**
	 * @return string
	 */
	protected function generate_lang_text() {
		$this->maybe_load_basic_data();

		return $this->lang_code_to_name( (string) $this->get_source_language_code() )
			   . html_entity_decode( ' &raquo; ' )
			   . $this->lang_code_to_name( (string) $this->get_language_code() );
	}

	/**
	 * @param string $code
	 *
	 * @return string
	 */
	private function lang_code_to_name( $code ) {
		global $sitepress;

		$lang_details = $sitepress->get_language_details( $code );

		return isset( $lang_details['display_name'] ) ? $lang_details['display_name'] : $code;
	}

	/**
	 * @param string $name
	 *
	 * @return mixed
	 */
	public function get_basic_data_property( $name ) {
		$this->maybe_load_basic_data();

		return Obj::prop( $name, $this->basic_data );
	}

	/**
	 * @param string $name
	 * @param mixed $value
	 */
	public function set_basic_data_property( $name, $value ) {
		$this->basic_data = Obj::assoc( $name, $value, $this->basic_data );
	}
}
