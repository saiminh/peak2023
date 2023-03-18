document.addEventListener('DOMContentLoaded', function() {
  const catfilter = document.querySelector('.peak-category-filter');
  catfilter && catfilter.querySelector('a[href="#categories"]').addEventListener('click', function(e) {
    e.preventDefault();
    catfilter.classList.toggle('expanded');
  })
})