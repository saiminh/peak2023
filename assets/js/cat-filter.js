document.addEventListener('DOMContentLoaded', function() {
  const catfilter = document.querySelector('.peak-category-filter');
  let cats = catfilter.querySelector('#categories');
  cats.style.display = 'block';
  let origHeight = cats.offsetHeight + 'px';
  cats.style.height = '0px';
  let isHovering = false;

  function toggleCatFilter(e) {
    e.preventDefault();
    let isOpen = catfilter.classList.contains('expanded');
    isOpen ? catfilter.classList.remove('expanded') : catfilter.classList.add('expanded');
    cats.style.height = isOpen ? '0px' : origHeight;
  }
  catfilter && catfilter.querySelector('a[href="#categories"]').addEventListener('click', function(e) {
    !isHovering ? toggleCatFilter(e) : e.preventDefault();
  })
  catfilter && catfilter.addEventListener('mouseenter', function(e) {
    isHovering = true;
    toggleCatFilter(e);
  })
  catfilter && catfilter.addEventListener('mouseleave', function(e) {
    isHovering = false;
    toggleCatFilter(e);
  })

  const searchField = document.querySelector('.wp-block-search__input');
  searchField && searchField.addEventListener('focusin', function(e) {
    searchField.closest('form').classList.add('search-focused');
  })
  searchField && searchField.addEventListener('focusout', function(e) {
    searchField.closest('form').classList.remove('search-focused');
  })
})