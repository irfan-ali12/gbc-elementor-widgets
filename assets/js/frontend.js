/**
 * GBC Elementor Widgets - Frontend JavaScript
 * Handles interactive features and styling enhancements
 */

(function($) {
    'use strict';

    /**
     * Initialize widgets on page load
     */
    $(document).ready(function() {
        // Enqueue styles for all GBC widgets
        enqueueWidgetStyles();
        
        // Initialize animations
        initializeAnimations();
        
        // Setup event listeners
        setupEventListeners();
    });

    /**
     * Enqueue styles for widgets
     */
    function enqueueWidgetStyles() {
        // Ensure Tailwind CSS classes are applied
        if (typeof Tailwind !== 'undefined') {
            // Reinitialize Tailwind if available
            if (Tailwind.nodewatch) {
                Tailwind.nodewatch.reinit();
            }
        }
    }

    /**
     * Initialize animations
     */
    function initializeAnimations() {
        // Add animation classes to elements
        $('.mascot-float').each(function() {
            $(this).css({
                'animation': 'mascotPeek 3s ease-in-out infinite alternate'
            });
        });

        // Add hover effects
        $('.group').each(function() {
            $(this).on('mouseenter', function() {
                $(this).find('.group-hover\\:-translate-y-2').addClass('active');
            }).on('mouseleave', function() {
                $(this).find('.group-hover\\:-translate-y-2').removeClass('active');
            });
        });
    }

    /**
     * Setup event listeners
     */
    function setupEventListeners() {
        // Button click handlers
        $(document).on('click', '.gbc-btn, [class*="gbc-cta"]', function() {
            // Add any custom click handlers here
        });

        // Contact form submission
        $(document).on('submit', '.gbc-contact-form', function(e) {
            e.preventDefault();
            handleContactFormSubmit(this);
        });

        // Window resize handler
        $(window).on('resize', function() {
            // Handle responsive behavior if needed
        });
    }

    /**
     * Handle contact form submission
     */
    function handleContactFormSubmit(form) {
        const $form = $(form);
        const $button = $form.find('button[type="submit"]');
        const buttonText = $button.text();
        const adminEmail = $form.data('admin-email');

        // Validate form
        if (!form.checkValidity()) {
            showFormMessage('Please fill in all required fields correctly.', 'error', $form);
            return;
        }

        // Disable button and show loading state
        $button.prop('disabled', true).text('Sending...');

        // Prepare form data
        const formData = {
            action: 'gbc_contact_form_submit',
            nonce: gbc_contact_nonce,
            name: $form.find('input[name="name"]').val(),
            email: $form.find('input[name="email"]').val(),
            message: $form.find('textarea[name="message"]').val(),
            admin_email: adminEmail
        };

        // Send AJAX request
        $.post(ajaxurl, formData, function(response) {
            if (response.success) {
                showFormMessage('Thank you! Your message has been sent successfully. We\'ll get back to you soon.', 'success', $form);
                $form[0].reset();
            } else {
                showFormMessage('Error: ' + (response.data || 'Failed to send message'), 'error', $form);
            }
            $button.prop('disabled', false).text(buttonText);
        }).fail(function() {
            showFormMessage('Error sending message. Please try again later.', 'error', $form);
            $button.prop('disabled', false).text(buttonText);
        });
    }

    /**
     * Show form message
     */
    function showFormMessage(message, type, $form) {
        // Remove existing message
        $form.find('.gbc-form-message').remove();

        // Create message element
        const messageClass = type === 'success' ? 'bg-green-50 border-green-200 text-green-800 dark:bg-green-900/20 dark:border-green-800 dark:text-green-300' : 'bg-red-50 border-red-200 text-red-800 dark:bg-red-900/20 dark:border-red-800 dark:text-red-300';
        const $message = $('<div class="gbc-form-message ' + messageClass + ' rounded-lg border p-4 mb-4 text-sm font-medium">' + message + '</div>');

        // Insert message at the top of the form
        $form.prepend($message);

        // Auto-hide success messages after 5 seconds
        if (type === 'success') {
            setTimeout(function() {
                $message.fadeOut(function() {
                    $(this).remove();
                });
            }, 5000);
        }
    }

    /**
     * Smooth scroll to section
     */
    function smoothScrollToSection(sectionId) {
        if (sectionId && $(sectionId).length) {
            $('html, body').animate({
                scrollTop: $(sectionId).offset().top - 100
            }, 1000);
        }
    }

    /**
     * Handle dark mode toggle
     */
    function toggleDarkMode() {
        $('html').toggleClass('dark');
        
        // Save preference to localStorage
        const isDark = $('html').hasClass('dark');
        localStorage.setItem('gbc-dark-mode', isDark ? 'true' : 'false');
    }

    /**
     * Load saved dark mode preference
     */
    function loadDarkModePreference() {
        const isDark = localStorage.getItem('gbc-dark-mode') === 'true';
        if (isDark) {
            $('html').addClass('dark');
        }
    }

    /**
     * Initialize on Elementor editor load
     */
    if (window.elementorFrontend) {
        window.elementorFrontend.hooks.addAction('frontend/element_ready/global', function() {
            enqueueWidgetStyles();
            initializeAnimations();
        });
    }

    // Expose functions globally if needed
    window.GBC_EW = {
        smoothScroll: smoothScrollToSection,
        toggleDarkMode: toggleDarkMode,
        loadDarkMode: loadDarkModePreference
    };

})(jQuery);
