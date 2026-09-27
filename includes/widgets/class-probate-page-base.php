<?php

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Shared controls and rendering for the three probate guide page widgets.
 */
abstract class GBC_EW_Probate_Page_Base extends Widget_Base {

    abstract protected function get_page_type();

    public function get_categories() {
        return [ 'general' ];
    }

    public function get_style_depends() {
        return [ 'gbc-ew-probate-pages' ];
    }

    protected function register_controls() {
        $defaults = $this->get_page_defaults();

        $this->register_hero_controls( $defaults );
        $this->register_credentials_controls();

        if ( 'understanding' === $this->get_page_type() ) {
            $this->register_understanding_controls();
        } elseif ( 'selling' === $this->get_page_type() ) {
            $this->register_selling_controls();
        } else {
            $this->register_preparing_controls();
        }

        $this->register_story_controls( $defaults );
    }

    protected function register_hero_controls( $defaults ) {
        $this->start_controls_section(
            'hero_section',
            [
                'label' => __( 'Hero', 'gbc-elementor-widgets' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'hero_eyebrow',
            [
                'label'   => __( 'Eyebrow', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Probate Real Estate Guide',
            ]
        );
        $this->add_control(
            'hero_title',
            [
                'label'   => __( 'Title', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXT,
                'default' => $defaults['hero_title'],
            ]
        );
        $this->add_control(
            'hero_intro',
            [
                'label'   => __( 'Introduction', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXTAREA,
                'rows'    => 5,
                'default' => $defaults['hero_intro'],
            ]
        );

        $this->end_controls_section();
    }

    protected function register_credentials_controls() {
        $this->start_controls_section(
            'credentials_section',
            [
                'label' => __( 'Credentials', 'gbc-elementor-widgets' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();
        $repeater->add_control(
            'image',
            [
                'label' => __( 'Logo', 'gbc-elementor-widgets' ),
                'type'  => Controls_Manager::MEDIA,
            ]
        );
        $repeater->add_control(
            'alt',
            [
                'label'   => __( 'Alt Text', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXT,
                'default' => '',
            ]
        );

        $this->add_control(
            'credentials',
            [
                'label'       => __( 'Credential Logos', 'gbc-elementor-widgets' ),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ alt }}}',
                'default'     => [
                    [
                        'image' => [ 'url' => 'https://mikekrealtor.com/wp-content/uploads/2026/01/certified-probate.png' ],
                        'alt'   => 'Certified Probate and Trust Specialist',
                    ],
                    [
                        'image' => [ 'url' => 'https://mikekrealtor.com/wp-content/uploads/2026/01/rene.png' ],
                        'alt'   => 'RENE Certification',
                    ],
                    [
                        'image' => [ 'url' => 'https://mikekrealtor.com/wp-content/uploads/2026/01/national-association-of-realtors-pn.png' ],
                        'alt'   => 'National Association of Realtors',
                    ],
                    [
                        'image' => [ 'url' => 'https://mikekrealtor.com/wp-content/uploads/2026/01/buyer-specialist.png' ],
                        'alt'   => 'KW First Time Buyer Specialist',
                    ],
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function register_story_controls( $defaults ) {
        $this->start_controls_section(
            'story_section',
            [
                'label' => __( 'Testimonial', 'gbc-elementor-widgets' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'story_image',
            [
                'label'   => __( 'Portrait', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [ 'url' => 'https://mikekrealtor.com/wp-content/uploads/2026/01/mike-profile.jpg' ],
            ]
        );
        $this->add_control(
            'story_quote',
            [
                'label'   => __( 'Quote', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXTAREA,
                'rows'    => 4,
                'default' => $defaults['story_quote'],
            ]
        );
        $this->add_control(
            'story_cite',
            [
                'label'   => __( 'Attribution', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Mike Karamanoukian · Senior Agent, KW Pasadena',
            ]
        );
        $this->end_controls_section();
    }

    protected function register_understanding_controls() {
        $this->start_controls_section( 'stats_section', [ 'label' => __( 'Statistics', 'gbc-elementor-widgets' ) ] );
        $repeater = new Repeater();
        $repeater->add_control( 'number', [ 'label' => __( 'Number', 'gbc-elementor-widgets' ), 'type' => Controls_Manager::TEXT ] );
        $repeater->add_control( 'label', [ 'label' => __( 'Label', 'gbc-elementor-widgets' ), 'type' => Controls_Manager::TEXT ] );
        $this->add_control(
            'stats',
            [
                'label'       => __( 'Statistics', 'gbc-elementor-widgets' ),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ number }}} — {{{ label }}}',
                'default'     => [
                    [ 'number' => '29', 'label' => 'Years Operated' ],
                    [ 'number' => '500+', 'label' => 'Local Families Trusted' ],
                    [ 'number' => '#1', 'label' => 'Brokerage for Closed Units, KW Pasadena' ],
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section( 'probate_meaning_section', [ 'label' => __( 'What Probate Means', 'gbc-elementor-widgets' ) ] );
        $this->add_control( 'meaning_eyebrow', [ 'label' => __( 'Eyebrow', 'gbc-elementor-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'What Probate Means' ] );
        $this->add_control( 'meaning_title', [ 'label' => __( 'Title', 'gbc-elementor-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'A process with a purpose, not just paperwork' ] );
        $this->add_control(
            'meaning_content',
            [
                'label'   => __( 'Content', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::WYSIWYG,
                'default' => '<p>Probate is the court-supervised process of settling a person\'s estate after they pass away. Assets are identified, debts are paid, and what remains is distributed according to the will, or, if there isn\'t one, California\'s laws of intestate succession. When a home is part of that estate, there are a few extra steps before it can be sold or transferred.</p><p>I\'ve sat on both sides of this. Before I was a Probate Process Specialist, I was the executor of my own mother\'s estate, working through multiple property sales during one of the harder chapters of my life. That\'s why this part of the business isn\'t theoretical for me. It\'s why I treat it as a responsibility, not a transaction.</p>',
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section( 'executor_section', [ 'label' => __( 'Executor Responsibilities', 'gbc-elementor-widgets' ) ] );
        $this->add_control( 'executor_eyebrow', [ 'label' => __( 'Eyebrow', 'gbc-elementor-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'The Role of the Executor' ] );
        $this->add_control( 'executor_title', [ 'label' => __( 'Title', 'gbc-elementor-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'Everything the executor is holding together' ] );
        $this->add_control(
            'executor_intro',
            [
                'label'   => __( 'Introduction', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXTAREA,
                'rows'    => 4,
                'default' => 'The executor keeps the estate moving in the right direction, coordinating with attorneys, the court, financial institutions, and family members who are often grieving at the same time. When real estate is involved, the executor usually decides whether the home is sold, kept, or transferred to an heir.',
            ]
        );
        $this->add_simple_text_repeater(
            'executor_items',
            __( 'Responsibilities', 'gbc-elementor-widgets' ),
            [
                'Working with the probate attorney to make sure legal requirements are met on time',
                'Identifying and documenting estate assets, including real estate, accounts, and personal property',
                'Keeping heirs and beneficiaries informed so no one is caught off guard',
                'Managing estate finances, including outstanding debts and ongoing obligations',
                'Maintaining and securing any property owned by the estate',
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section( 'timeline_section', [ 'label' => __( 'Probate Timeline', 'gbc-elementor-widgets' ) ] );
        $this->add_control( 'timeline_eyebrow', [ 'label' => __( 'Eyebrow', 'gbc-elementor-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'What to Expect' ] );
        $this->add_control( 'timeline_title', [ 'label' => __( 'Title', 'gbc-elementor-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'A simplified probate timeline in California' ] );
        $this->add_control( 'timeline_intro', [ 'label' => __( 'Introduction', 'gbc-elementor-widgets' ), 'type' => Controls_Manager::TEXTAREA, 'default' => 'Every estate is different, but most probate matters involving real estate in Los Angeles County follow a similar general path.' ] );
        $repeater = new Repeater();
        $repeater->add_control( 'title', [ 'label' => __( 'Title', 'gbc-elementor-widgets' ), 'type' => Controls_Manager::TEXT ] );
        $repeater->add_control( 'description', [ 'label' => __( 'Description', 'gbc-elementor-widgets' ), 'type' => Controls_Manager::TEXTAREA ] );
        $this->add_control(
            'timeline_items',
            [
                'label'       => __( 'Timeline Steps', 'gbc-elementor-widgets' ),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ title }}}',
                'default'     => [
                    [ 'title' => 'The estate is opened with the court', 'description' => 'The process begins when the will is filed and a petition is submitted to the probate court.' ],
                    [ 'title' => 'An executor or administrator is appointed', 'description' => 'The court confirms the executor named in the will, or appoints an administrator when there isn\'t one.' ],
                    [ 'title' => 'Assets are identified and documented', 'description' => 'Real property, accounts, investments, and personal belongings are inventoried.' ],
                    [ 'title' => 'A decision is made about the property', 'description' => 'The executor and heirs work out whether the home will be sold, kept, or transferred.' ],
                    [ 'title' => 'The home is prepared and listed, if selling', 'description' => 'This is where I typically step in, helping get the property cleaned up, priced, and marketed properly.' ],
                    [ 'title' => 'Proceeds are distributed', 'description' => 'Once the sale closes and debts are settled, remaining funds go to the heirs according to the estate plan.' ],
                ],
            ]
        );
        $this->add_control( 'disclaimer', [ 'label' => __( 'Disclaimer', 'gbc-elementor-widgets' ), 'type' => Controls_Manager::TEXTAREA, 'default' => 'This page is for general information only and isn\'t legal, financial, or tax advice. For guidance specific to your situation, talk with a licensed probate attorney.' ] );
        $this->end_controls_section();

        $this->start_controls_section( 'terms_section', [ 'label' => __( 'Terms Worth Knowing', 'gbc-elementor-widgets' ) ] );
        $this->add_control( 'terms_eyebrow', [ 'label' => __( 'Eyebrow', 'gbc-elementor-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'Terms Worth Knowing' ] );
        $this->add_control( 'terms_title', [ 'label' => __( 'Title', 'gbc-elementor-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'A few words you\'ll hear along the way' ] );
        $this->add_control( 'terms_intro', [ 'label' => __( 'Introduction', 'gbc-elementor-widgets' ), 'type' => Controls_Manager::TEXTAREA, 'default' => 'Probate comes with its own vocabulary. Here\'s what the terms that come up most often actually mean.' ] );
        $repeater = new Repeater();
        $repeater->add_control( 'term', [ 'label' => __( 'Term', 'gbc-elementor-widgets' ), 'type' => Controls_Manager::TEXT ] );
        $repeater->add_control( 'definition', [ 'label' => __( 'Definition', 'gbc-elementor-widgets' ), 'type' => Controls_Manager::TEXTAREA ] );
        $this->add_control(
            'terms',
            [
                'label'       => __( 'Terms', 'gbc-elementor-widgets' ),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ term }}}',
                'default'     => [
                    [ 'term' => 'Executor', 'definition' => 'The person named in the will, or appointed by the court, responsible for managing the estate and carrying out its distribution. Also called the personal representative.' ],
                    [ 'term' => 'Testate', 'definition' => 'When someone dies leaving a valid will, their estate is distributed according to the instructions it contains.' ],
                    [ 'term' => 'Intestate', 'definition' => 'When someone dies without a will, the estate is distributed according to California\'s laws rather than personal instructions.' ],
                    [ 'term' => 'Probate Court', 'definition' => 'In California, this is the Superior Court in the county where the deceased lived. It oversees the administration and distribution of the estate.' ],
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section( 'faq_section', [ 'label' => __( 'Questions I Hear Often', 'gbc-elementor-widgets' ) ] );
        $this->add_control( 'faq_eyebrow', [ 'label' => __( 'Eyebrow', 'gbc-elementor-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'Questions I Hear Often' ] );
        $this->add_control( 'faq_title', [ 'label' => __( 'Title', 'gbc-elementor-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'A couple of things families usually ask first' ] );
        $repeater = new Repeater();
        $repeater->add_control( 'question', [ 'label' => __( 'Question', 'gbc-elementor-widgets' ), 'type' => Controls_Manager::TEXT ] );
        $repeater->add_control( 'answer', [ 'label' => __( 'Answer', 'gbc-elementor-widgets' ), 'type' => Controls_Manager::TEXTAREA ] );
        $this->add_control(
            'faqs',
            [
                'label'       => __( 'Questions', 'gbc-elementor-widgets' ),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ question }}}',
                'default'     => [
                    [ 'question' => 'Do all estates go through probate?', 'answer' => 'Not always. It depends on how the assets were titled. Property held in a living trust or with a named beneficiary often passes without probate, but real estate titled only in the deceased\'s name typically does need to go through the process.' ],
                    [ 'question' => 'How long does probate take?', 'answer' => 'It varies with the estate\'s complexity and the local court\'s schedule, but most cases run anywhere from a few months to over a year. The real estate portion can often move forward while other parts of the estate are still being resolved.' ],
                ],
            ]
        );
        $this->end_controls_section();
    }

    protected function register_selling_controls() {
        $this->start_controls_section( 'situations_section', [ 'label' => __( 'Common Situations', 'gbc-elementor-widgets' ) ] );
        $this->add_control( 'situations_eyebrow', [ 'label' => __( 'Eyebrow', 'gbc-elementor-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'Situations We Commonly Help With' ] );
        $this->add_control( 'situations_title', [ 'label' => __( 'Title', 'gbc-elementor-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'You\'re probably not the first family to face this' ] );
        $this->add_control( 'situations_intro', [ 'label' => __( 'Introduction', 'gbc-elementor-widgets' ), 'type' => Controls_Manager::TEXTAREA, 'default' => 'Probate real estate rarely follows a straight line. Here are some of the situations I see most often in El Monte, Alhambra, Pasadena, and across the San Gabriel Valley.' ] );
        $this->add_simple_text_repeater(
            'situations',
            __( 'Situations', 'gbc-elementor-widgets' ),
            [
                'Multiple heirs who need to agree on selling and dividing the proceeds fairly',
                'A property that needs repairs, updates, or a full cleanout before it can go on the market',
                'A vacant home that needs ongoing maintenance and security while probate is underway',
                'An executor living out of state who needs someone local and trustworthy handling the sale',
                'A house full of belongings that need to be sorted, distributed, donated, or removed',
                'A family that simply isn\'t sure yet whether to sell, keep, or rent',
            ]
        );
        $this->add_control( 'situations_closing', [ 'label' => __( 'Closing Text', 'gbc-elementor-widgets' ), 'type' => Controls_Manager::TEXTAREA, 'default' => 'If any of this sounds familiar, you\'re not alone. I\'ve been the executor sorting through a parent\'s home myself, and I know how much clearer things get once you have a plan.' ] );
        $this->end_controls_section();

        $this->start_controls_section( 'sale_during_probate_section', [ 'label' => __( 'Sale During Probate', 'gbc-elementor-widgets' ) ] );
        $this->add_control( 'sale_during_probate_title', [ 'label' => __( 'Title', 'gbc-elementor-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'Can the house be sold during probate?' ] );
        $this->add_control(
            'sale_during_probate_text',
            [
                'label'   => __( 'Text', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXTAREA,
                'rows'    => 5,
                'default' => 'In most cases, yes. Whether the sale can proceed usually depends on the authority the will grants the executor and guidance from the estate\'s attorney. Some estates give the executor full authority to sell, while others need court approval first. Either way, working with someone experienced in probate sales helps keep the process moving within the legal timeline.',
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section( 'options_section', [ 'label' => __( 'Property Options', 'gbc-elementor-widgets' ) ] );
        $this->add_control( 'options_eyebrow', [ 'label' => __( 'Eyebrow', 'gbc-elementor-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'Weighing Your Options' ] );
        $this->add_control( 'options_title', [ 'label' => __( 'Title', 'gbc-elementor-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'Three paths families generally consider' ] );
        $this->add_control( 'options_intro', [ 'label' => __( 'Introduction', 'gbc-elementor-widgets' ), 'type' => Controls_Manager::TEXTAREA, 'default' => 'There\'s no single right answer here, it depends on your family\'s finances, timeline, and how the heirs feel about the property.' ] );
        $repeater = new Repeater();
        $repeater->add_control( 'icon', [ 'label' => __( 'Icon', 'gbc-elementor-widgets' ), 'type' => Controls_Manager::SELECT, 'options' => $this->get_icon_options(), 'default' => 'home' ] );
        $repeater->add_control( 'tag', [ 'label' => __( 'Tag', 'gbc-elementor-widgets' ), 'type' => Controls_Manager::TEXT ] );
        $repeater->add_control( 'title', [ 'label' => __( 'Title', 'gbc-elementor-widgets' ), 'type' => Controls_Manager::TEXT ] );
        $repeater->add_control( 'description', [ 'label' => __( 'Description', 'gbc-elementor-widgets' ), 'type' => Controls_Manager::TEXTAREA ] );
        $this->add_control(
            'options',
            [
                'label'       => __( 'Options', 'gbc-elementor-widgets' ),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ title }}}',
                'default'     => [
                    [ 'icon' => 'home', 'tag' => 'Most Common', 'title' => 'Sell the Property', 'description' => 'Converts the home into liquid assets that can cover debts and be divided among heirs. Especially common with multiple beneficiaries or when no one plans to live in the home.' ],
                    [ 'icon' => 'key', 'tag' => 'Keep It', 'title' => 'Keep the Property', 'description' => 'Some families keep the home, whether as a residence or for sentimental reasons. Usually means one heir buying out the others, or agreeing to shared ownership.' ],
                    [ 'icon' => 'building', 'tag' => 'Rent It Out', 'title' => 'Rent the Property', 'description' => 'Can create ongoing income for the estate or heirs, but it also means someone has to manage the property and the tenant relationship long term.' ],
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section( 'preparation_callout_section', [ 'label' => __( 'Preparation Guide Callout', 'gbc-elementor-widgets' ) ] );
        $this->add_control( 'callout_title', [ 'label' => __( 'Title', 'gbc-elementor-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'Decided to sell? Get the home ready the right way' ] );
        $this->add_control( 'callout_text', [ 'label' => __( 'Text', 'gbc-elementor-widgets' ), 'type' => Controls_Manager::TEXTAREA, 'default' => 'Securing the property, sorting belongings, handling small repairs, and pricing it correctly all matter before it hits the market. I put together a full walkthrough of each step.' ] );
        $this->add_control( 'callout_link_text', [ 'label' => __( 'Link Text', 'gbc-elementor-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'Read the full preparation guide →' ] );
        $this->add_control( 'callout_link', [ 'label' => __( 'Link', 'gbc-elementor-widgets' ), 'type' => Controls_Manager::URL, 'default' => [ 'url' => '/preparing-home-for-sale/' ] ] );
        $this->end_controls_section();

        $this->start_controls_section( 'as_is_section', [ 'label' => __( 'As-Is Sale', 'gbc-elementor-widgets' ) ] );
        $this->add_control( 'as_is_eyebrow', [ 'label' => __( 'Eyebrow', 'gbc-elementor-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'Another Path Worth Considering' ] );
        $this->add_control( 'as_is_title', [ 'label' => __( 'Title', 'gbc-elementor-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'Considering an as-is sale' ] );
        $this->add_control( 'as_is_intro', [ 'label' => __( 'Introduction', 'gbc-elementor-widgets' ), 'type' => Controls_Manager::TEXTAREA, 'default' => 'For some families, selling the property exactly as it is makes the most sense. Here\'s what that path can offer.' ] );
        $this->add_simple_text_repeater(
            'as_is_items',
            __( 'Benefits', 'gbc-elementor-widgets' ),
            [
                'A faster path from listing to closing, which can help wrap up the estate sooner',
                'No time or money spent on repairs or renovations before selling',
                'Less stress for an executor already juggling a long list of responsibilities',
                'Fewer carrying costs like taxes, insurance, and utilities while the estate is open',
                'Less coordination needed with contractors and repair timelines',
                'A practical option when the executor lives far away and can\'t oversee the work',
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section( 'professionals_section', [ 'label' => __( 'Trusted Professionals', 'gbc-elementor-widgets' ) ] );
        $this->add_control( 'professionals_eyebrow', [ 'label' => __( 'Eyebrow', 'gbc-elementor-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'You Don\'t Have to Find Them Alone' ] );
        $this->add_control( 'professionals_title', [ 'label' => __( 'Title', 'gbc-elementor-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'Trusted professionals I can put you in touch with' ] );
        $this->add_control(
            'professionals_intro',
            [
                'label'   => __( 'Introduction', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXTAREA,
                'rows'    => 4,
                'default' => 'Settling an estate usually calls for more than one kind of help. I work with people in each of these categories around Alhambra and the San Gabriel Valley, and I\'m glad to make an introduction when you need one.',
            ]
        );
        $repeater = new Repeater();
        $repeater->add_control( 'category', [ 'label' => __( 'Category', 'gbc-elementor-widgets' ), 'type' => Controls_Manager::TEXT ] );
        $repeater->add_control( 'description', [ 'label' => __( 'Description', 'gbc-elementor-widgets' ), 'type' => Controls_Manager::TEXTAREA ] );
        $this->add_control(
            'professionals',
            [
                'label'       => __( 'Professional Categories', 'gbc-elementor-widgets' ),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ category }}}',
                'default'     => [
                    [ 'category' => 'Probate Attorneys', 'description' => 'To guide the legal and court side of the process' ],
                    [ 'category' => 'Estate Sale Companies', 'description' => 'To price, market, and run a sale of remaining belongings' ],
                    [ 'category' => 'Cleanout Services', 'description' => 'To clear furniture, belongings, and debris from the home' ],
                    [ 'category' => 'Appraisers', 'description' => 'For certified property valuations for estate purposes' ],
                    [ 'category' => 'Property Maintenance', 'description' => 'To secure, clean, and maintain the home while it\'s vacant' ],
                    [ 'category' => 'Title Professionals', 'description' => 'To ensure a clean title transfer at closing' ],
                ],
            ]
        );
        $this->add_control( 'professionals_closing_before', [ 'label' => __( 'Closing Text Before Link', 'gbc-elementor-widgets' ), 'type' => Controls_Manager::TEXTAREA, 'default' => 'Nothing obliges you to use anyone I recommend, and any advisor your family has already chosen is welcome to stay involved.' ] );
        $this->add_control( 'professionals_link_text', [ 'label' => __( 'Referral Link Text', 'gbc-elementor-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'Ask me for a referral' ] );
        $this->add_control(
            'professionals_link',
            [
                'label'       => __( 'Referral Link', 'gbc-elementor-widgets' ),
                'type'        => Controls_Manager::URL,
                'default'     => [ 'url' => '/contact/' ],
                'description' => __( 'Replace this URL when the dedicated referral link is provided.', 'gbc-elementor-widgets' ),
            ]
        );
        $this->add_control( 'professionals_closing_after', [ 'label' => __( 'Closing Text After Link', 'gbc-elementor-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => 'whenever you need one.' ] );
        $this->end_controls_section();
    }

    protected function register_preparing_controls() {
        $steps = $this->get_preparing_steps();

        foreach ( $steps as $index => $step ) {
            $number = $index + 1;
            $this->start_controls_section(
                'step_' . $number . '_section',
                [ 'label' => sprintf( __( 'Step %d', 'gbc-elementor-widgets' ), $number ) ]
            );
            $this->add_control( 'step_' . $number . '_index', [ 'label' => __( 'Step Label', 'gbc-elementor-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => $step['index'] ] );
            $this->add_control( 'step_' . $number . '_icon', [ 'label' => __( 'Icon', 'gbc-elementor-widgets' ), 'type' => Controls_Manager::SELECT, 'options' => $this->get_icon_options(), 'default' => $step['icon'] ] );
            $this->add_control( 'step_' . $number . '_title', [ 'label' => __( 'Title', 'gbc-elementor-widgets' ), 'type' => Controls_Manager::TEXT, 'default' => $step['title'] ] );
            $this->add_control( 'step_' . $number . '_description', [ 'label' => __( 'Description', 'gbc-elementor-widgets' ), 'type' => Controls_Manager::TEXTAREA, 'rows' => 4, 'default' => $step['description'] ] );
            $this->add_control(
                'step_' . $number . '_items',
                [
                    'label'       => __( 'Checklist (one item per line)', 'gbc-elementor-widgets' ),
                    'type'        => Controls_Manager::TEXTAREA,
                    'rows'        => 8,
                    'default'     => implode( "\n", $step['items'] ),
                    'description' => __( 'Add each checklist item on a separate line.', 'gbc-elementor-widgets' ),
                ]
            );
            $this->end_controls_section();
        }

        $this->start_controls_section( 'preparing_disclaimer_section', [ 'label' => __( 'Disclaimer', 'gbc-elementor-widgets' ) ] );
        $this->add_control( 'disclaimer', [ 'label' => __( 'Text', 'gbc-elementor-widgets' ), 'type' => Controls_Manager::TEXTAREA, 'default' => 'This page is for general information only and isn\'t legal, financial, or tax advice. For guidance specific to your situation, talk with a licensed professional.' ] );
        $this->end_controls_section();
    }

    protected function add_simple_text_repeater( $control_name, $label, $items ) {
        $repeater = new Repeater();
        $repeater->add_control( 'text', [ 'label' => __( 'Text', 'gbc-elementor-widgets' ), 'type' => Controls_Manager::TEXTAREA ] );
        $defaults = [];
        foreach ( $items as $item ) {
            $defaults[] = [ 'text' => $item ];
        }
        $this->add_control(
            $control_name,
            [
                'label'       => $label,
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ text }}}',
                'default'     => $defaults,
            ]
        );
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="gbc-probate-page gbc-probate-page--<?php echo esc_attr( $this->get_page_type() ); ?>">
            <?php $this->render_hero( $settings ); ?>
            <?php $this->render_credentials( $settings ); ?>
            <?php
            if ( 'understanding' === $this->get_page_type() ) {
                $this->render_understanding( $settings );
            } elseif ( 'selling' === $this->get_page_type() ) {
                $this->render_selling( $settings );
            } else {
                $this->render_preparing( $settings );
            }
            ?>
            <?php $this->render_story( $settings ); ?>
        </div>
        <?php
    }

    protected function render_hero( $settings ) {
        ?>
        <section class="gbc-probate-hero">
            <div class="gbc-probate-hero-glow" aria-hidden="true"></div>
            <div class="gbc-probate-container">
                <div class="gbc-probate-hero-inner">
                    <?php $this->render_eyebrow( $settings['hero_eyebrow'], true ); ?>
                    <h1><?php echo esc_html( $settings['hero_title'] ); ?></h1>
                    <p class="gbc-probate-lead"><?php echo esc_html( $settings['hero_intro'] ); ?></p>
                </div>
            </div>
        </section>
        <?php
    }

    protected function render_credentials( $settings ) {
        if ( empty( $settings['credentials'] ) ) {
            return;
        }
        ?>
        <section class="gbc-probate-credentials">
            <div class="gbc-probate-container gbc-probate-credential-row">
                <?php foreach ( $settings['credentials'] as $credential ) : ?>
                    <?php if ( ! empty( $credential['image']['url'] ) ) : ?>
                        <img src="<?php echo esc_url( $credential['image']['url'] ); ?>" alt="<?php echo esc_attr( $credential['alt'] ); ?>">
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </section>
        <?php
    }

    protected function render_understanding( $settings ) {
        ?>
        <section class="gbc-probate-section gbc-probate-section--flush-top">
            <div class="gbc-probate-container">
                <div class="gbc-probate-stat-band">
                    <?php foreach ( $settings['stats'] as $stat ) : ?>
                        <div class="gbc-probate-stat">
                            <div class="gbc-probate-stat-number"><?php echo esc_html( $stat['number'] ); ?></div>
                            <div class="gbc-probate-stat-label"><?php echo esc_html( $stat['label'] ); ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <section class="gbc-probate-section">
            <div class="gbc-probate-container gbc-probate-two-col">
                <div><?php $this->render_eyebrow( $settings['meaning_eyebrow'] ); ?><h2><?php echo esc_html( $settings['meaning_title'] ); ?></h2></div>
                <div><?php echo wp_kses_post( $settings['meaning_content'] ); ?></div>
            </div>
        </section>
        <section class="gbc-probate-section gbc-probate-section--alt">
            <div class="gbc-probate-container gbc-probate-two-col">
                <div>
                    <?php $this->render_eyebrow( $settings['executor_eyebrow'] ); ?>
                    <h2><?php echo esc_html( $settings['executor_title'] ); ?></h2>
                    <p class="gbc-probate-lead"><?php echo esc_html( $settings['executor_intro'] ); ?></p>
                </div>
                <?php $this->render_check_list( $settings['executor_items'], 'gbc-probate-check-list', true ); ?>
            </div>
        </section>
        <section class="gbc-probate-section">
            <div class="gbc-probate-container">
                <div class="gbc-probate-section-head">
                    <?php $this->render_eyebrow( $settings['timeline_eyebrow'] ); ?>
                    <h2><?php echo esc_html( $settings['timeline_title'] ); ?></h2>
                    <p class="gbc-probate-lead"><?php echo esc_html( $settings['timeline_intro'] ); ?></p>
                </div>
                <ol class="gbc-probate-timeline">
                    <?php foreach ( $settings['timeline_items'] as $item ) : ?>
                        <li><h4><?php echo esc_html( $item['title'] ); ?></h4><p><?php echo esc_html( $item['description'] ); ?></p></li>
                    <?php endforeach; ?>
                </ol>
                <p class="gbc-probate-disclaimer gbc-probate-disclaimer--bordered"><?php echo esc_html( $settings['disclaimer'] ); ?></p>
            </div>
        </section>
        <section class="gbc-probate-section gbc-probate-section--alt">
            <div class="gbc-probate-container">
                <div class="gbc-probate-section-head">
                    <?php $this->render_eyebrow( $settings['terms_eyebrow'] ); ?>
                    <h2><?php echo esc_html( $settings['terms_title'] ); ?></h2>
                    <p class="gbc-probate-lead"><?php echo esc_html( $settings['terms_intro'] ); ?></p>
                </div>
                <div class="gbc-probate-term-grid">
                    <?php foreach ( $settings['terms'] as $term ) : ?>
                        <div class="gbc-probate-term-card">
                            <h3><?php echo esc_html( $term['term'] ); ?></h3>
                            <p><?php echo esc_html( $term['definition'] ); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <section class="gbc-probate-section">
            <div class="gbc-probate-container">
                <div class="gbc-probate-section-head">
                    <?php $this->render_eyebrow( $settings['faq_eyebrow'] ); ?>
                    <h2><?php echo esc_html( $settings['faq_title'] ); ?></h2>
                </div>
                <ul class="gbc-probate-faq-list">
                    <?php foreach ( $settings['faqs'] as $faq ) : ?>
                        <li>
                            <h4><?php echo esc_html( $faq['question'] ); ?></h4>
                            <p><?php echo esc_html( $faq['answer'] ); ?></p>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </section>
        <?php
    }

    protected function render_selling( $settings ) {
        ?>
        <section class="gbc-probate-section gbc-probate-section--alt">
            <div class="gbc-probate-container">
                <div class="gbc-probate-section-head">
                    <?php $this->render_eyebrow( $settings['situations_eyebrow'] ); ?>
                    <h2><?php echo esc_html( $settings['situations_title'] ); ?></h2>
                    <p class="gbc-probate-lead"><?php echo esc_html( $settings['situations_intro'] ); ?></p>
                </div>
                <div class="gbc-probate-accent-grid">
                    <?php foreach ( $settings['situations'] as $item ) : ?>
                        <div class="gbc-probate-accent-card"><p><?php echo esc_html( $item['text'] ); ?></p></div>
                    <?php endforeach; ?>
                </div>
                <p style="margin-top:30px;max-width:68ch"><?php echo esc_html( $settings['situations_closing'] ); ?></p>
            </div>
        </section>
        <section class="gbc-probate-section">
            <div class="gbc-probate-container">
                <div class="gbc-probate-callout">
                    <span class="gbc-probate-callout-icon"><?php echo $this->get_icon_svg( 'info' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
                    <div>
                        <h3><?php echo esc_html( $settings['sale_during_probate_title'] ); ?></h3>
                        <p><?php echo esc_html( $settings['sale_during_probate_text'] ); ?></p>
                    </div>
                </div>
            </div>
        </section>
        <section class="gbc-probate-section gbc-probate-section--alt">
            <div class="gbc-probate-container">
                <div class="gbc-probate-section-head">
                    <?php $this->render_eyebrow( $settings['options_eyebrow'] ); ?>
                    <h2><?php echo esc_html( $settings['options_title'] ); ?></h2>
                    <p class="gbc-probate-lead"><?php echo esc_html( $settings['options_intro'] ); ?></p>
                </div>
                <div class="gbc-probate-option-grid">
                    <?php foreach ( $settings['options'] as $option ) : ?>
                        <div class="gbc-probate-option-card">
                            <span class="gbc-probate-option-icon"><?php echo $this->get_icon_svg( $option['icon'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
                            <span class="gbc-probate-option-tag"><?php echo esc_html( $option['tag'] ); ?></span>
                            <h3><?php echo esc_html( $option['title'] ); ?></h3>
                            <p><?php echo esc_html( $option['description'] ); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <section class="gbc-probate-section">
            <div class="gbc-probate-container">
                <div class="gbc-probate-callout">
                    <span class="gbc-probate-callout-icon"><?php echo $this->get_icon_svg( 'box' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
                    <div>
                        <h3><?php echo esc_html( $settings['callout_title'] ); ?></h3>
                        <p><?php echo esc_html( $settings['callout_text'] ); ?></p>
                        <?php $this->render_link( $settings['callout_link'], $settings['callout_link_text'], 'gbc-probate-text-link' ); ?>
                    </div>
                </div>
            </div>
        </section>
        <section class="gbc-probate-section gbc-probate-section--alt">
            <div class="gbc-probate-container">
                <div class="gbc-probate-highlight">
                    <div class="gbc-probate-section-head">
                        <?php $this->render_eyebrow( $settings['as_is_eyebrow'], true ); ?>
                        <h2><?php echo esc_html( $settings['as_is_title'] ); ?></h2>
                        <p class="gbc-probate-lead"><?php echo esc_html( $settings['as_is_intro'] ); ?></p>
                    </div>
                    <?php $this->render_check_list( $settings['as_is_items'], 'gbc-probate-highlight-list' ); ?>
                </div>
            </div>
        </section>
        <section class="gbc-probate-section">
            <div class="gbc-probate-container">
                <div class="gbc-probate-section-head">
                    <?php $this->render_eyebrow( $settings['professionals_eyebrow'] ); ?>
                    <h2><?php echo esc_html( $settings['professionals_title'] ); ?></h2>
                    <p class="gbc-probate-lead"><?php echo esc_html( $settings['professionals_intro'] ); ?></p>
                </div>
                <div class="gbc-probate-professional-grid">
                    <?php foreach ( $settings['professionals'] as $professional ) : ?>
                        <div class="gbc-probate-accent-card">
                            <h3><?php echo esc_html( $professional['category'] ); ?></h3>
                            <p><?php echo esc_html( $professional['description'] ); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
                <p class="gbc-probate-professionals-closing">
                    <?php echo esc_html( $settings['professionals_closing_before'] ); ?>
                    <?php $this->render_link( $settings['professionals_link'], $settings['professionals_link_text'], 'gbc-probate-referral-link' ); ?>
                    <?php echo esc_html( $settings['professionals_closing_after'] ); ?>
                </p>
            </div>
        </section>
        <?php
    }

    protected function render_preparing( $settings ) {
        for ( $number = 1; $number <= 4; $number++ ) {
            $reverse = 0 === $number % 2;
            ?>
            <?php if ( $number > 1 ) : ?><div class="gbc-probate-gap" aria-hidden="true"></div><?php endif; ?>
            <section class="gbc-probate-section<?php echo $reverse ? ' gbc-probate-section--alt' : ''; ?>">
                <div class="gbc-probate-container">
                    <div class="gbc-probate-zigzag<?php echo $reverse ? ' gbc-probate-zigzag--reverse' : ''; ?>">
                        <div class="gbc-probate-zigzag-media">
                            <div class="gbc-probate-step-index"><?php echo esc_html( $settings[ 'step_' . $number . '_index' ] ); ?></div>
                            <span class="gbc-probate-zigzag-icon"><?php echo $this->get_icon_svg( $settings[ 'step_' . $number . '_icon' ] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
                            <h2><?php echo esc_html( $settings[ 'step_' . $number . '_title' ] ); ?></h2>
                            <p><?php echo esc_html( $settings[ 'step_' . $number . '_description' ] ); ?></p>
                        </div>
                        <?php $this->render_textarea_check_list( $settings[ 'step_' . $number . '_items' ] ); ?>
                    </div>
                </div>
            </section>
            <?php
        }
        ?>
        <section class="gbc-probate-section">
            <div class="gbc-probate-container">
                <p class="gbc-probate-disclaimer" style="margin-left:auto;margin-right:auto;max-width:68ch;text-align:center"><?php echo esc_html( $settings['disclaimer'] ); ?></p>
            </div>
        </section>
        <?php
    }

    protected function render_story( $settings ) {
        ?>
        <section class="gbc-probate-section gbc-probate-section--alt">
            <div class="gbc-probate-container">
                <div class="gbc-probate-story">
                    <?php if ( ! empty( $settings['story_image']['url'] ) ) : ?>
                        <img src="<?php echo esc_url( $settings['story_image']['url'] ); ?>" alt="<?php echo esc_attr( $settings['story_cite'] ); ?>">
                    <?php endif; ?>
                    <div>
                        <span class="gbc-probate-quote-mark" aria-hidden="true">&ldquo;</span>
                        <blockquote><?php echo esc_html( $settings['story_quote'] ); ?></blockquote>
                        <cite><?php echo esc_html( $settings['story_cite'] ); ?></cite>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }

    protected function render_eyebrow( $text, $dark = false ) {
        if ( '' === trim( $text ) ) {
            return;
        }
        ?>
        <span class="gbc-probate-eyebrow<?php echo $dark ? ' gbc-probate-eyebrow--dark' : ''; ?>">
            <span class="gbc-probate-eyebrow-dot"></span><?php echo esc_html( $text ); ?>
        </span>
        <?php
    }

    protected function render_check_list( $items, $class_name, $tile = false ) {
        ?>
        <ul class="<?php echo esc_attr( $class_name ); ?>">
            <?php foreach ( $items as $item ) : ?>
                <li>
                    <?php if ( $tile ) : ?><span class="gbc-probate-icon-tile"><?php endif; ?>
                    <?php echo $this->get_icon_svg( 'check' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                    <?php if ( $tile ) : ?></span><?php endif; ?>
                    <p><?php echo esc_html( $item['text'] ); ?></p>
                </li>
            <?php endforeach; ?>
        </ul>
        <?php
    }

    protected function render_textarea_check_list( $text ) {
        $items = preg_split( '/\R/', (string) $text );
        ?>
        <ul class="gbc-probate-zigzag-list">
            <?php foreach ( $items as $item ) : ?>
                <?php if ( '' !== trim( $item ) ) : ?>
                    <li><?php echo $this->get_icon_svg( 'check' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><p><?php echo esc_html( trim( $item ) ); ?></p></li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
        <?php
    }

    protected function render_link( $link, $text, $class_name ) {
        if ( empty( $link['url'] ) || empty( $text ) ) {
            return;
        }
        $target = ! empty( $link['is_external'] ) ? ' target="_blank"' : '';
        $rel = ! empty( $link['nofollow'] ) ? ' rel="nofollow"' : '';
        printf(
            '<a class="%1$s" href="%2$s"%3$s%4$s>%5$s</a>',
            esc_attr( $class_name ),
            esc_url( $link['url'] ),
            $target,
            $rel,
            esc_html( $text )
        );
    }

    protected function get_page_defaults() {
        $defaults = [
            'understanding' => [
                'hero_title' => 'Understanding Probate and Real Estate',
                'hero_intro' => 'Probate has a way of feeling like a maze at the exact moment you have the least energy for one. I\'ve walked this path myself, as administrator of my own mother\'s estate, and I built my practice around making it clearer for the families who come after.',
                'story_quote' => 'I was the executor sorting through a parent\'s home myself. My job now is to protect your interests, guide you clearly, and make sure we get it right.',
            ],
            'selling' => [
                'hero_title' => 'Selling an Inherited Home',
                'hero_intro' => 'When a home becomes part of an estate, the family has to decide what happens to it next. Selling is the most common path, but keeping or renting are also worth considering. I\'ll walk you through what each option actually looks like so the decision feels informed, not rushed.',
                'story_quote' => 'I\'ve been the executor sorting through a parent\'s home myself. Let\'s figure out which option actually fits your family, not just the one that sounds easiest.',
            ],
            'preparing' => [
                'hero_title' => 'Preparing the Home for Sale',
                'hero_intro' => 'Getting an inherited home ready for the market looks different from one property to the next. Some homes need very little, others need a real plan. Either way, breaking it down into a few clear steps takes a lot of the stress out of the process.',
                'story_quote' => 'Not sure where to start? I\'ll walk you through it step by step and help you build a plan that fits your family\'s timeline and situation.',
            ],
        ];
        return $defaults[ $this->get_page_type() ];
    }

    protected function get_preparing_steps() {
        return [
            [
                'index' => '01 · First Things First',
                'icon' => 'shield',
                'title' => 'Securing the property',
                'description' => 'One of the first things to handle after inheriting a home is making sure it\'s safe and protected. A little attention early on can prevent bigger, more expensive problems later.',
                'items' => [
                    'Review the homeowner\'s insurance policy, some policies lapse or exclude coverage once a home sits vacant',
                    'Forward or hold the mail, an overflowing mailbox is one of the clearest signs a home is empty',
                    'Keep the utilities on, including water and heating or cooling, to prevent frozen pipes or mold',
                    'Change the locks and check every entry point, including garages, windows, and side doors',
                    'Set light timers or arrange periodic check-ins so the home looks lived in rather than vacant',
                ],
            ],
            [
                'index' => '02 · The Hardest Part',
                'icon' => 'box',
                'title' => 'Handling personal belongings',
                'description' => 'This is usually the most emotional part of preparing an inherited home. I try to make it as manageable as possible for the families I work with.',
                'items' => [
                    'Let family members go through the home first so anyone with sentimental attachments can choose what matters most',
                    'Consider an estate sale for items the family isn\'t keeping, a professional company can price and run it for you',
                    'Donate what\'s usable, many local nonprofits will pick up furniture and household goods at no cost',
                    'Bring in a cleanout service for anything left behind, they handle the hauling and disposal',
                    'Photograph and document valuable items before they\'re distributed or sold, for insurance and estate accounting',
                ],
            ],
            [
                'index' => '03 · Getting Market Ready',
                'icon' => 'tool',
                'title' => 'Repairs and improvements',
                'description' => 'Depending on the home\'s condition, a few targeted repairs can go a long way. The goal is appeal without overspending on upgrades that won\'t pay you back.',
                'items' => [
                    'A deep clean of the whole house, carpets, windows, kitchen, and bathrooms, makes a strong first impression',
                    'Basic yard work, mowing, trimming, clearing walkways, and fresh mulch, improves curb appeal affordably',
                    'Small repairs, leaky faucets, damaged drywall, sticking doors, add up in a buyer\'s mind more than expected',
                    'Cosmetic refreshes like neutral paint or updated cabinet hardware can modernize a home affordably',
                    'Address safety issues such as loose railings, missing smoke detectors, or exposed wiring before an inspection',
                ],
            ],
            [
                'index' => '04 · Getting the Number Right',
                'icon' => 'tag',
                'title' => 'Pricing the property',
                'description' => 'Setting the right price is one of the most important calls in this whole process, and it should be grounded in more than a guess.',
                'items' => [
                    'The home\'s current condition plays a big role, a property needing work is priced differently than move-in ready',
                    'Recent comparable sales and current days-on-market trends show what the market is actually doing right now',
                    'Buyer demand in the area, which shifts by season and by neighborhood across the San Gabriel Valley',
                    'Your family\'s timeline, a faster sale sometimes means a different pricing strategy than testing the market',
                    'A professional market analysis gives you a realistic number to work from, not a hopeful one',
                ],
            ],
        ];
    }

    protected function get_icon_options() {
        return [
            'home' => __( 'Home', 'gbc-elementor-widgets' ),
            'key' => __( 'Key', 'gbc-elementor-widgets' ),
            'building' => __( 'Building', 'gbc-elementor-widgets' ),
            'shield' => __( 'Shield', 'gbc-elementor-widgets' ),
            'box' => __( 'Box', 'gbc-elementor-widgets' ),
            'tool' => __( 'Tool', 'gbc-elementor-widgets' ),
            'tag' => __( 'Tag', 'gbc-elementor-widgets' ),
        ];
    }

    protected function get_icon_svg( $icon ) {
        $paths = [
            'check' => '<path d="M20 6L9 17l-5-5"/>',
            'info' => '<circle cx="12" cy="12" r="9"/><path d="M12 8v5"/><circle cx="12" cy="16" r=".5" fill="currentColor"/>',
            'home' => '<path d="M3 11l9-7 9 7"/><path d="M5 10v10h14V10"/>',
            'key' => '<circle cx="8" cy="15" r="4"/><path d="M10.5 12.5L19 4M19 4h-4M19 4v4"/>',
            'building' => '<rect x="4" y="3" width="16" height="18" rx="1"/><path d="M9 8h1M14 8h1M9 12h1M14 12h1M9 16h1M14 16h1"/>',
            'shield' => '<path d="M12 3l8 3v6c0 5-3.5 8-8 9-4.5-1-8-4-8-9V6l8-3z"/>',
            'box' => '<path d="M21 8l-9-5-9 5 9 5 9-5z"/><path d="M3 8v8l9 5 9-5V8"/><path d="M12 13v8"/>',
            'tool' => '<path d="M14.7 6.3a1 1 0 000 1.4l1.6 1.6a1 1 0 001.4 0l3.1-3.1a4 4 0 01-5.4 5.4L6 21H3v-3l10.3-10.3a4 4 0 015.4-5.4l-3.1 3.1z"/>',
            'tag' => '<path d="M20.6 12.5L12.5 20.6a2 2 0 01-2.8 0l-6.3-6.3a2 2 0 010-2.8L11.5 3.4A2 2 0 0113 2.8h6a2 2 0 012 2v6a2 2 0 01-.4 1.7z"/><circle cx="15.5" cy="8.5" r="1.5"/>',
        ];
        $path = isset( $paths[ $icon ] ) ? $paths[ $icon ] : $paths['home'];
        return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . $path . '</svg>';
    }
}
