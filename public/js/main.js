(function () {
  'use strict';

  const header = document.getElementById('header');
  const nav = document.getElementById('nav');
  const navToggle = document.getElementById('navToggle');

  // Sticky header shadow (disabled since header is now relative)
  // if (header) {
  //   window.addEventListener('scroll', function () {
  //     header.classList.toggle('header--scrolled', window.scrollY > 10);
  //   }, { passive: true });
  // }

  // Mobile nav toggle
  if (navToggle && nav) {
    navToggle.addEventListener('click', function () {
      nav.classList.toggle('nav--open');
      navToggle.setAttribute('aria-expanded', nav.classList.contains('nav--open'));
    });

    nav.querySelectorAll('.nav__link').forEach(function (link) {
      link.addEventListener('click', function () {
        nav.classList.remove('nav--open');
      });
    });
  }

  // Pricing package selection
  const pricingButtons = document.querySelectorAll('[data-package]');
  pricingButtons.forEach(function (btn) {
    btn.addEventListener('click', function (e) {
      const selectedPackage = this.getAttribute('data-package');
      const packageSelect = document.getElementById('package');
      
      if (packageSelect) {
        packageSelect.value = selectedPackage;
      }
      
      // Scroll to contact section
      const contactSection = document.getElementById('contact');
      if (contactSection) {
        contactSection.scrollIntoView({ behavior: 'smooth' });
      }
    });
  });

  // Multi-step form functionality
  const contactForm = document.getElementById('contactForm');
  if (contactForm) {
    let currentQuestion = 1;
    const totalQuestions = 6;
    const questions = contactForm.querySelectorAll('.form-question');
    const nextButtons = contactForm.querySelectorAll('.form-next-btn');
    const prevButtons = contactForm.querySelectorAll('.form-prev-btn');

    console.log('Form found:', contactForm);
    console.log('Questions found:', questions.length);
    console.log('Next buttons found:', nextButtons.length);
    console.log('Prev buttons found:', prevButtons.length);

    // Update question visibility
    function updateQuestion(questionNum) {
      currentQuestion = questionNum;

      questions.forEach(function (question) {
        const qNum = parseInt(question.dataset.question);
        question.classList.remove('form-question--active');
        if (qNum === questionNum) {
          question.classList.add('form-question--active');
        }
      });
    }

    // Validate current question
    function validateQuestion(questionNum) {
      const currentQuestionEl = contactForm.querySelector('.form-question[data-question="' + questionNum + '"]');
      const requiredFields = currentQuestionEl.querySelectorAll('[required]');
      let valid = true;

      requiredFields.forEach(function (field) {
        if (field.type === 'radio') {
          const radioGroup = contactForm.querySelectorAll('input[name="' + field.name + '"]');
          const isChecked = Array.from(radioGroup).some(function (radio) {
            return radio.checked;
          });
          if (!isChecked) {
            valid = false;
          }
        } else {
          if (!field.checkValidity()) {
            field.style.borderColor = '#ef4444';
            valid = false;
          } else {
            field.style.borderColor = '';
          }
        }
      });

      return valid;
    }

    // Next button handlers
    nextButtons.forEach(function (btn) {
      btn.addEventListener('click', function () {
        console.log('Next button clicked, current question:', currentQuestion);
        const isValid = validateQuestion(currentQuestion);
        console.log('Validation result:', isValid);
        
        if (isValid && currentQuestion < totalQuestions) {
          console.log('Moving to question:', currentQuestion + 1);
          updateQuestion(currentQuestion + 1);
        } else {
          console.log('Validation failed or at last question');
          // Show validation error by highlighting invalid fields
          const currentQuestionEl = contactForm.querySelector('.form-question[data-question="' + currentQuestion + '"]');
          const requiredFields = currentQuestionEl.querySelectorAll('[required]');
          requiredFields.forEach(function (field) {
            if (field.type === 'radio') {
              const radioGroup = contactForm.querySelectorAll('input[name="' + field.name + '"]');
              const isChecked = Array.from(radioGroup).some(function (radio) {
                return radio.checked;
              });
              if (!isChecked) {
                radioGroup.forEach(function (radio) {
                  radio.closest('.radio-group').style.border = '2px solid #ef4444';
                  radio.closest('.radio-group').style.borderRadius = '8px';
                  radio.closest('.radio-group').style.padding = '4px';
                });
              }
            } else if (!field.checkValidity()) {
              field.style.borderColor = '#ef4444';
            }
          });
        }
      });
    });

    // Previous button handlers
    prevButtons.forEach(function (btn) {
      btn.addEventListener('click', function () {
        if (currentQuestion > 1) {
          updateQuestion(currentQuestion - 1);
        }
      });
    });

    // Conditional field display for radio buttons
    const radioMappings = {
      'website_type': 'website_type_other_field',
      'industry': 'industry_other_field',
      'purpose': 'purpose_other_field'
    };

    Object.keys(radioMappings).forEach(function (radioName) {
      const radioButtons = contactForm.querySelectorAll('input[name="' + radioName + '"]');
      const conditionalField = document.getElementById(radioMappings[radioName]);

      radioButtons.forEach(function (radio) {
        radio.addEventListener('change', function () {
          if (this.value === 'other' && conditionalField) {
            conditionalField.style.display = 'block';
          } else if (conditionalField) {
            conditionalField.style.display = 'none';
          }
        });
      });
    });

    // Form submission validation
    contactForm.addEventListener('submit', function (e) {
      // Validate all questions
      let allValid = true;
      for (let i = 1; i <= totalQuestions; i++) {
        if (!validateQuestion(i)) {
          allValid = false;
          updateQuestion(i);
          break;
        }
      }

      if (!allValid) {
        e.preventDefault();
      } else if (window.fbq) {
        window.fbq('track', 'Lead');
      }
    });

    // Clear validation styles on input
    contactForm.querySelectorAll('input, textarea, select').forEach(function (field) {
      field.addEventListener('input', function () {
        if (field.checkValidity()) {
          field.style.borderColor = '';
        }
        // Clear radio group validation
        if (field.type === 'radio') {
          const radioGroup = contactForm.querySelectorAll('input[name="' + field.name + '"]');
          radioGroup.forEach(function (radio) {
            radio.closest('.radio-group').style.border = '';
            radio.closest('.radio-group').style.padding = '';
          });
        }
      });
    });
  }

  // Store UTM source in sessionStorage
  var params = new URLSearchParams(window.location.search);
  if (params.get('utm_source')) {
    sessionStorage.setItem('utm_source', params.get('utm_source'));
    var sourceInput = document.querySelector('input[name="source"]');
    if (sourceInput) {
      sourceInput.value = params.get('utm_source');
    }
  }

  // Portfolio carousel - duplicate items for seamless infinite scroll
  const carouselTrack = document.querySelector('.portfolio-carousel__track');
  if (carouselTrack) {
    const items = carouselTrack.querySelectorAll('.portfolio-item');
    if (items.length > 0) {
      // Clone items and append to create seamless loop
      items.forEach(function (item) {
        const clone = item.cloneNode(true);
        carouselTrack.appendChild(clone);
      });
    }
  }
})();
