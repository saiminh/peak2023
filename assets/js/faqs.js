window.onload = function() {
  document.querySelectorAll('.peak-faq').forEach(faq => {
    faq.querySelector('.peak-faq-question').addEventListener('click', function(e) {
      e.preventDefault();
      let isOpen = faq.classList.contains('peak-faq-open');
      document.querySelector('.peak-faq-open') && document.querySelector('.peak-faq-open').classList.remove('peak-faq-open');
      isOpen ? faq.classList.remove('peak-faq-open') : faq.classList.add('peak-faq-open');
      window.scrollTo({
        top: faq.offsetTop - 50,
        behavior: 'smooth'
      });
    })
  })
}