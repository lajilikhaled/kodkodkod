import 'intersection-observer';

const formattedDate = (dataString) => {
  const dateObj = new Date(dataString);
  return `${dateObj.getDate()}/${dateObj.getMonth() + 1}/${dateObj.getFullYear()}`;
};

// Get the third segment of the path
const isBlogPath = window.location.pathname.split('/')[2] === 'blog';

document.addEventListener('DOMContentLoaded', () => {
  const blogsContainer = document.getElementsByClassName('landingPage-blogs');
  const blogsContainerBox = document.getElementById('blogs-container-2-box');

  let page = 1;
  const pageSize = 4;
  const loaderImg = require('../images/blog/spinner.gif');

  function loadMoreItems() {
    if (document.getElementById('loader-img')) document.getElementById('loader-img').remove();

    const loader = document.createElement('div');
    loader.innerHTML = `
      <img src="${loaderImg}" id="loader-img" style="width: auto; height: auto; max-width: 50px; max-height: 50px; position: absolute; left: 50%;" loading="lazy"/>
    `;
    blogsContainer[0].appendChild(loader);

    // Get the text translate
    const translatedPosted = document.getElementsByClassName('card__date-container-2')[0].getAttribute('data-blog-posted-translated');

    fetch(`/load-more?page=${page}&pageSize=${pageSize}`)
      .then(response => response.json())
      .then(data => {
        if (data.length > 0) {
          const divBoxLine = document.createElement('div');
          divBoxLine.classList.add('box-line');

          data.forEach(item => {
            const divCardItem = document.createElement('div');
            divCardItem.classList.add('card-item');

            const url = `/${item.locale}/article/${item.slug}`;
            const imgSrc = `/images/blog/${item.image}`;

            divCardItem.innerHTML = `
              <a href="${url}">
                  <figure class="card__img">
                      <img src="${imgSrc}" alt="${item.title}" loading="lazy"/>
                  </figure>
                  <div class="card__content">
                      <div class="title">${item.title}</div>
                      <div class="text">${item.metaDescription}</div>
                  </div>
                  <div class="card__date">${translatedPosted} ${formattedDate(item.posted)}</div>
              </a>
            `;
            divBoxLine.appendChild(divCardItem);
          });
          blogsContainerBox.appendChild(divBoxLine);
          page++;
          // Stop observation if nb items < 4 => no items remain
          if (data.length < 4) observer.unobserve(document.getElementById('intersection-observer-trigger'));

        } else {
          // Stop observation when no items remain
          observer.unobserve(document.getElementById('intersection-observer-trigger'));
        }
      }).catch((err) => {
        console.error(err);
      })
      .finally(() => {
        // Remove loader img
        if (document.getElementById('loader-img')) document.getElementById('loader-img').remove();
      });
  }
  const observer = new IntersectionObserver(entries => {
    if (entries[0].intersectionRatio <= 0) return;
    loadMoreItems();
  }, { rootMargin: '100px 0px 0px 0px' });

  if (isBlogPath && document.getElementById('intersection-observer-trigger')) observer.observe(document.getElementById('intersection-observer-trigger'));
});