<?php
/**
 * The Events Calendar Customizer Section Class
 * Month View
 *
 * @since TBD
 */

namespace Tribe\Events\Views\V2\Customizer\Section;

/**
 * Month View
 *
 * @since TBD
 */
class Month_View extends \Tribe__Customizer__Section {

	 /**
     * ID of the section.
     *
     * @since 4.0
     *
     * @access public
     * @var string
     */
    public $ID = 'month_view';

	/**
     * This method will be executed when the Class is Initialized.
     */
	public function setup() {
		parent::setup();

		$this->defaults = [
			'grid_lines_color'                => '#e4e4e4',
			'grid_background_color_choice'    => 'transparent',
			'grid_background_color'           => '#FFFFFF',
			'days_of_week_color'              => '#5d5d5d',
			'date_marker_color'               => '#141827',
			'multiday_event_bar_color_choice' => 'accent',
			'multiday_background_color'       => '#334aff',
			'tooltip_background_color_choice' => 'default',
			'tooltip_background_color'        => 'default',
		];

		$this->arguments = [
			'priority'    => 65,
			'capability'  => 'edit_theme_options',
			'title'       => esc_html__( 'Month View', 'the-events-calendar' ),
			'description' => esc_html__( 'Options selected here will override what was selected in the "Global Elements" section.', 'the-events-calendar' ),
		];
	}

	public function setup_content_headings() {
		$this->content_headings = [
			'grid' => [
				'priority'     => 0,
				'type'         => 'heading',
				'label'        => esc_html_x(
					'Calendar Grid',
					'The header for the calendar grid color control section.',
					'the-events-calendar'
				),
			],
			'month_view_separator' => [
				'priority'     => 10,
				'type'         => 'separator',
			],
			'date_day' => [
				'priority'     => 11,
				'type'         => 'heading',
				'label'        => esc_html_x(
					'Date and Day',
					'The header for the date and day color control section.',
					'the-events-calendar'
				),
			]
		];
	}

	public function setup_content_settings() {
		$this->content_settings = [
			'grid_lines_color'                => [
				'sanitize_callback'    => 'sanitize_hex_color',
				'sanitize_js_callback' => 'maybe_hash_hex_color',
			],
			'grid_background_color_choice'    => [
				'sanitize_callback'    => 'sanitize_key',
				'sanitize_js_callback' => 'sanitize_key',
			],
			'grid_background_color'           => [
				'sanitize_callback'    => 'sanitize_hex_color',
				'sanitize_js_callback' => 'maybe_hash_hex_color',
			],
			'tooltip_background_color'        => [
				'sanitize_callback'    => 'sanitize_key',
				'sanitize_js_callback' => 'sanitize_key',
			],
			'days_of_week_color'              => [
				'sanitize_callback'    => 'sanitize_hex_color',
				'sanitize_js_callback' => 'maybe_hash_hex_color',
			],
			'date_marker_color'               => [
				'sanitize_callback'    => 'sanitize_hex_color',
				'sanitize_js_callback' => 'maybe_hash_hex_color',
			],
			'multiday_event_bar_color_choice' => [
				'sanitize_callback'    => 'sanitize_key',
				'sanitize_js_callback' => 'sanitize_key',
			],
			'multiday_event_bar_color'        => [
				'sanitize_callback'    => 'sanitize_hex_color',
				'sanitize_js_callback' => 'maybe_hash_hex_color',
			]
		];
	}

	public function get_events_background_link() {
		$control                     = tribe( 'customizer' )->get_setting_name( 'background_color_choice', 'global_elements' );
		$query['autofocus[control]'] = 'tribe_customizer' . $control;
		$control_url                 = add_query_arg( $query, admin_url( 'customize.php' ) );
		$control_text                = esc_html__( 'Events Background Color', 'the-events-calendar' );

		return sprintf(
			'<a href="%s">%s</a>',
			$control_url,
			$control_text
		);
	}

	public function get_accent_color_link() {
		$control                     = tribe( 'customizer' )->get_setting_name( 'accent_color', 'global_elements' );
		$query['autofocus[control]'] = 'tribe_customizer' . $control;
		$control_url                 = add_query_arg( $query, admin_url( 'customize.php' ) );
		$control_text                = esc_html__( 'Accent Color', 'the-events-calendar' );

		return sprintf(
			'<a href="%s">%s</a>',
			$control_url,
			$control_text
		);
	}

	public function get_events_background_color() {
		return tribe('customizer')->get_option( [ 'global_elements', 'background_color' ] );
	}

	public function get_accent_color() {
		return tribe('customizer')->get_option( [ 'global_elements', 'accent_color' ] );
	}

	public function setup_content_controls() {
		$this->content_controls = [
			'grid_lines_color'         => [
				'type'         => 'color',
				'label'        => esc_html_x(
					'Grid lines color',
					'The grid lines color setting label.',
					'the-events-calendar'
				),
				'priority'     => 3,
			],
			'grid_background_color_choice'    => [
				'priority'     => 6,
				'type'         => 'radio',
				'label'        => esc_html_x(
					'Grid background color',
					'The grid background color setting label.',
					'the-events-calendar'
				),
				'description'  => esc_html_x(
					'The Month View grid background',
					'The grid background color setting description.',
					'the-events-calendar'
				),
				'choices'      => [
					'transparent' => _x(
						'Transparent  - the ' . $this->get_events_background_link() . ' <span style="color: ' . $this->get_events_background_color() . ';"  class="dashicons dashicons-image-filter"></span> will show through.',
						'Label for option to leave transparent (default).',
						'the-events-calendar'
					),
					'custom'      => esc_html_x(
						'Select Custom Color',
						'Label for option to set a custom color.',
						'the-events-calendar'
					),
				],
			],
			'grid_background_color'    => [
				'label'           => esc_html_x(
					'Custom Color',
					'Label for custom background color setting.',
					'the-events-calendar'
				),
				'type'            => 'color',
				'priority'        => 7,
				'active_callback' => function( $control ) {
					$setting_name = tribe( 'customizer' )->get_setting_name( 'grid_background_color_choice', $control->section );
					$value = $control->manager->get_setting( $setting_name )->value();
					return $this->defaults['grid_background_color_choice'] !== $value;
				},

			],
			'tooltip_background_color'    => [
				'label'           => esc_html_x(
					'Tooltip Background Color',
					'Label for tooltip background color setting.',
					'the-events-calendar'
				),
				'type'            => 'radio',
				'priority'        => 7,
				'active_callback' => function( $control ) {
					$setting_name = tribe( 'customizer' )->get_setting_name( 'grid_background_color_choice', $control->section );
					$value = $control->manager->get_setting( $setting_name )->value();
					return $this->defaults['grid_background_color_choice'] === $value;
				},
				'description'  => esc_html_x(
					'The Tooltip Background Color',
					'The grid background color setting description.',
					'the-events-calendar'
				),
				'choices'      => [
					'default' => _x(
						'Use the default background color. <span style="color: #FFFFFF;" class="dashicons dashicons-image-filter"></span>',
						'Label for option to leave white (default).',
						'the-events-calendar'
					),
					'event'      => _x(
						'Use the ' . $this->get_events_background_link() . '. <span style="color: ' . $this->get_events_background_color() . ';"  class="dashicons dashicons-image-filter"></span>',
						'Label for option to use the event background color.',
						'the-events-calendar'
					),
				],

			],
			'days_of_week_color'       => [
				'priority'     => 13,
				'type'         => 'color',
				'label'        => esc_html_x(
					'Days of the Week color',
					'The days of the week text color setting label.',
					'the-events-calendar'
				),
				'description'  => esc_html_x(
					'Text color for the Days of the Week',
					'The days of the week text color setting description.',
					'the-events-calendar'
				),
			],
			'date_marker_color'        => [
				'priority'     => 16,
				'type'         => 'color',
				'label'        => esc_html_x(
					'Date Marker color',
					'The date marker text color setting label.',
					'the-events-calendar'
				),
				'description'  => esc_html_x(
					'The Month View grid lines',
					'The date marker text color setting description.',
					'the-events-calendar'
				),
			],
			'multiday_event_bar_color_choice' => [
				'priority'     => 19,
				'control_type' => 'default',
				'type'         => 'radio',
				'label'        => esc_html_x(
					'Multiday Event Bar Color',
					'The multiday event bar color setting label.',
					'the-events-calendar'
				),
				'description'  => esc_html_x(
					'The Month View multiday and all-day event bar background color.',
					'The multiday event bar color setting description.',
					'the-events-calendar'
				),
				'choices'      => [
					'accent' => _x(
						'Use the ' . $this->get_accent_color_link() . ' <span style="color:' . $this->get_accent_color() . '" class="dashicons dashicons-image-filter"></span>',
						'Label for option to use the accent color.',
						'the-events-calendar'
					),
					'custom'      => esc_html_x(
						'Select Custom Color',
						'Label for option to set a custom color.',
						'the-events-calendar'
					),
				],
			],
			'multiday_event_bar_color' => [
				'priority'     => 20,
				'control_type' => 'color',
				'label'        => esc_html_x(
					'Custom Color',
					'The multiday event bar custom color setting label.',
					'the-events-calendar'
				),
				'active_callback' => function( $control ) {
					$setting_name = tribe( 'customizer' )->get_setting_name( 'multiday_event_bar_color_choice', $control->section );
					$value = $control->manager->get_setting( $setting_name )->value();
					return $this->defaults['multiday_event_bar_color_choice'] !== $value;
				}
			],
		];
	}
}