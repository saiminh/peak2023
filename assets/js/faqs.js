window.onload = function() {
  document.querySelectorAll('.peak-faq').forEach(faq => {
    const q = faq.querySelector('.peak-faq-answer');
    q.style.display = 'block';
    let origHeight = q.offsetHeight + 'px';
    q.style.height = '0px';
    
    faq.querySelector('.peak-faq-question').addEventListener('click', function(e) {
      e.preventDefault();
      let isOpen = faq.classList.contains('peak-faq-open');
      isOpen ? faq.classList.remove('peak-faq-open') : faq.classList.add('peak-faq-open');
      q.style.height = isOpen ? '0px' : origHeight;
    })
  })
}