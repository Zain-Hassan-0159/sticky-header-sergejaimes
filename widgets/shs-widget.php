<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor List Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Elementor_Shs_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve list widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'shs';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve list widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Sticky Header Sergejaimes', 'elementor-list-widget' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve list widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-header';
	}

	/**
	 * Get custom help URL.
	 *
	 * Retrieve a URL where the user can get more information about the widget.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget help URL.
	 */
	public function get_custom_help_url() {
		return 'https://developers.elementor.com/docs/widgets/';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the list widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'general' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the list widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'header', 'nav', 'sticky header', 'sergejaimes' ];
	}

    public function get_script_depends() {
		return [ 'sticky-nav-shs' ];
	}


	/**
	 * Register list widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'General', 'hz-widgets' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'sticky_container_width',
			[
				'label' => esc_html__( 'Sticky Nav Width', 'hz-widgets' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 2000,
						'step' => 5,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 1180,
				],
				'selectors' => [
					'{{WRAPPER}} .abs_active nav' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'item_title',
			[
				'label' => esc_html__( 'Title', 'hz-widgets' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'List Title' , 'hz-widgets' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'target_id',
			[
				'label' => esc_html__( 'Target Section ID', 'hz-widgets' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '' , 'hz-widgets' ),
				'label_block' => true,
			]
		);


		$this->add_control(
			'sticky_list',
			[
				'label' => esc_html__( 'Add Sticky Items', 'hz-widgets' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'item_title' => esc_html__( 'Title #1', 'hz-widgets' ),
					],
					[
						'item_title' => esc_html__( 'Title #2', 'hz-widgets' ),
					],
					[
						'item_title' => esc_html__( 'Title #3', 'hz-widgets' ),
					],
					[
						'item_title' => esc_html__( 'Title #4', 'hz-widgets' ),
					],
					[
						'item_title' => esc_html__( 'Title #5', 'hz-widgets' ),
					],
					[
						'item_title' => esc_html__( 'Title #6', 'hz-widgets' ),
					],
				],
				'title_field' => '{{{ item_title }}}',
			]
		);


        $this->end_controls_section();

		$this->start_controls_section(
			'style_section_normal',
			[
				'label' => esc_html__( 'Normal Style', 'hz-widgets' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'counter_typography',
				'label' => esc_html__( 'Counter Typography', 'hz-widgets' ),
				'selector' => '{{WRAPPER}} a.step-link .step-number',
			]
		);

		$this->add_responsive_control(
			'counter_color',
			[
				'label' => esc_html__( 'Counter Color', 'hz-widgets' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} a.step-link .step-number' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'counter_border_color',
			[
				'label' => esc_html__( 'Counter Border Color', 'hz-widgets' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} a.step-link .step-number' => 'border-color: {{VALUE}}',
					'{{WRAPPER}} .sticky_header li:not(:first-child):before' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'counter_width',
			[
				'label' => esc_html__( 'Counter Size', 'hz-widgets' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 5,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 48,
				],
				'selectors' => [
					'{{WRAPPER}} .step-number' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',

				],
			]
		);

		$this->add_responsive_control(
			'line_top',
			[
				'label' => esc_html__( 'Line Position from Top', 'hz-widgets' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 27,
				],
				'selectors' => [
					'{{WRAPPER}} .sticky_header li:not(:first-child):before' => 'top: {{SIZE}}{{UNIT}};',

				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'label_typography',
				'label' => esc_html__( 'Label Typography', 'hz-widgets' ),
				'selector' => '{{WRAPPER}} a.step-link .step-name',
			]
		);

		$this->add_responsive_control(
			'label_color',
			[
				'label' => esc_html__( 'Label Color', 'hz-widgets' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} a.step-link .step-name' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_section_sticky',
			[
				'label' => esc_html__( 'Sticky Style', 'hz-widgets' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'sticky_counter_typography',
				'label' => esc_html__( 'Counter Typography', 'hz-widgets' ),
				'selector' => '{{WRAPPER}} .abs_active a.step-link .step-number',
			]
		);

		$this->add_responsive_control(
			'sticky_counter_color',
			[
				'label' => esc_html__( 'Counter Color', 'hz-widgets' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .abs_active a.step-link .step-number' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'sticky_active_counter_color',
			[
				'label' => esc_html__( 'Counter Active Color', 'hz-widgets' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sticky_header.abs_active a.step-link.active .step-number' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'sticky_active_counter_bgcolor',
			[
				'label' => esc_html__( 'Counter Active Bg Color', 'hz-widgets' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sticky_header.abs_active a.step-link.active .step-number' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'sticky_counter_border_color',
			[
				'label' => esc_html__( 'Counter Border Color', 'hz-widgets' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .abs_active a.step-link .step-number' => 'border-color: {{VALUE}}',
					'{{WRAPPER}} .sticky_header.abs_active li:not(:first-child):before' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'sticky_counter_width',
			[
				'label' => esc_html__( 'Counter Size', 'hz-widgets' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 5,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 25,
				],
				'selectors' => [
					'{{WRAPPER}} .abs_active .step-number' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',

				],
			]
		);

		$this->add_responsive_control(
			'sticky_line_top',
			[
				'label' => esc_html__( 'Line Position from Top', 'hz-widgets' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 14,
				],
				'selectors' => [
					'{{WRAPPER}} .sticky_header.abs_active li:not(:first-child):before' => 'top: {{SIZE}}{{UNIT}};',

				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'sticky_label_typography',
				'label' => esc_html__( 'Label Typography', 'hz-widgets' ),
				'selector' => '{{WRAPPER}} .abs_active a.step-link .step-name',
			]
		);

		$this->add_responsive_control(
			'sticky_label_color',
			[
				'label' => esc_html__( 'Label Color', 'hz-widgets' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .abs_active a.step-link .step-name' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();
	}



	/**
	 * Render list widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();


        ?>
		<style>
			.abs_active nav{
				width: 100%;
				margin: auto;
			}

			.sticky_header ul {
				display: flex;
				justify-content: center;
				align-items: center;
				list-style: none;
				padding: 0;
			}

			a.step-link {
				display: flex;
				flex-direction: column;
				align-items: center;
				color: black;
				font-size: 20px;
				font-weight: 600;
				gap: 30px;
			}

			.step-number {
				border: 2px solid #d1d9dd;
				border-radius: 50%;
				display: flex;
				justify-content: center;
				align-items: center;
				width: 48px;
				height: 48px;
			}

			.sticky_header li {
				flex: 1;
				position: relative;
			}

			.sticky_header li:not(:first-child):before {
				background-color: var(--borderColor,#d1d9dd);
				content: "";
				height: 2px;
				left: -25%;
				position: absolute;
				top: 27px;
				width: 50%;
				transition: width .15s;
				transition-timing-function: ease-in-out;
			}

			.sticky_header {
				transition-duration: .15s;
				transition-property: all;
				transition-timing-function: ease-in-out;
				transform-origin: bottom;
			}

			.sticky_header.abs_active {
				background-color: var(--bgColor,#fff);
				box-shadow: 0 2px 5px 0 hsla(0,0%,83%,.4);
				left: 0;
				min-height: unset;
				position: fixed;
				top: 0;
				width: 100%;
				z-index: 99;
				padding: 20px 0;
			}

			.admin-bar .sticky_header.abs_active {
				top: 32px;
			}

			.abs_active a.step-link {
				font-size: 14px;
				gap: 10px;
			}

			.abs_active a.step-link .step-number {
				width: 25px;
				height: 25px;
			}

			.sticky_header.abs_active li:not(:first-child):before  {
				width: 0%;
				top: 9px;
				left: -31%;
			}

			.sticky_header.abs_active li.w-50:not(:first-child):before  {
				width: 60%;
				background-color: #424242;
				top: 9px;
				left: -31%;
			}

			.sticky_header.abs_active a.step-link {
				color: #d1d9dd;
			}

			.sticky_header.abs_active a.step-link.active{
				color: #424242;
			}

			.sticky_header.abs_active a.step-link.active .step-number {
				border-color: #424242;
				background-color: #424242;
				color: white;
			}

			.sticky_header .icon{
				display: none;
			}

			@media(max-width: 800px){
				.sticky_header ul {
					flex-direction: column;
					align-items: flex-start;
					gap: 20px;
				}

				a.step-link {
					flex-direction: row;
					gap: 20px;
				}

				.step-number {
					width: 38px;
					height: 38px;
				}

				.sticky_header li:not(:first-child):before {
					content: unset;
				}

				.abs_active .d-sm-none{
					display: none;
				}

				.sticky_header.abs_active .icon{
					display: block;
					flex: 1;
    				text-align: right;
				}

				.sticky_header li{
					width: 100%;
				}

				.sticky_header.abs_active{
					padding: 20px;
				}
			}

			@media(max-width: 600px){
				.admin-bar .sticky_header.abs_active {
					top: 0;
				}
			}
		</style>
        <div class="sticky_header">
            <nav>
				<?php if($settings['sticky_list']) : 
					$counter = 1;
				?>
                <ul>
					<?php foreach($settings['sticky_list'] as $item) : ?>
                    <li class="<?php echo $counter === 1 ? '' : 'd-sm-none'; ?>">
                        <a data-href="#<?php echo $item['target_id'] ?>" href="#<?php echo $item['target_id'] ?>" class="step-link">
                            <div class="step-number"><?php echo $counter; ?></div>
                            <div class="step-name"><?php echo $item['item_title'] ?></div>
							<div class="icon">
								<svg width="10" height="6" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8.60958 0.687671C8.78209 0.47204 9.09674 0.437079 9.31237 0.609584C9.528 0.782089 9.56296 1.09674 9.39045 1.31237L5.39045 5.31237C5.19029 5.56257 4.80975 5.56257 4.60958 5.31237L0.609584 1.31237C0.437079 1.09674 0.47204 0.782089 0.687671 0.609584C0.903302 0.437079 1.21795 0.47204 1.39045 0.687671L5.00002 4.19963L8.60958 0.687671Z" fill="#424242"></path></svg>
							</div>
                        </a>
                    </li>
					<?php 
					$counter++;
					endforeach; 
					?>
                </ul>
				<?php endif; ?>
            </nav>
        </div>
        <?php     if ( \Elementor\Plugin::$instance->editor->is_edit_mode()) : ?>
			<script>
			jQuery(document).ready(function ($) {

				function checkSpecialSectionTop() {
					const distanceFromTop = specialSectionTop - $(window).scrollTop();

					// Check if the special section is 10px from the top
					if (distanceFromTop <= 30) {
						setTimeout(function () {
							sticky_header.addClass("abs_active")
						}, 300);
						// You can add your custom code or actions here
					}

					// Check if the special section is 10px from the top
					if (distanceFromTop >= 31) {
						setTimeout(function () {
							sticky_header.removeClass("abs_active")
						}, 300);
						// You can add your custom code or actions here
					}
				}

				const sticky_header = $('.sticky_header');
				const specialSectionTop = sticky_header.offset().top;
				const selected_sections = $('.sticky_header ul li a');
				// Attach scroll event listener
				$(window).scroll(function () {
					checkSpecialSectionTop();

					selected_sections.each(function(){
						const distanceFromTop = $(window).scrollTop();
						const item = $(this);
						const itemTop = $(item.data('href'))?.offset()?.top;
						if((distanceFromTop + 150) > itemTop){
							// setTimeout(function () {
								$('li').addClass('d-sm-none')
								item.addClass("active")
								item.closest("li").addClass('w-50').removeClass('d-sm-none')
							// }, 300);

						}else{
							// setTimeout(function () {
								item.removeClass("active")
								item.closest("li").removeClass('w-50')
							// }, 300);

						}
					})

				});
			});
		</script>
        <?php endif; ?>
		<?php
	}

}