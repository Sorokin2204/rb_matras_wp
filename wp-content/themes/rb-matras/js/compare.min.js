let emptyCellCount = document.querySelectorAll(
  '.compare__grid-title--empty',
).length;
const grid = document.querySelector('.compare__grid');
const emptyCells = document.querySelectorAll('.compare__grid-cell--empty');
const scrollBtnRight = document.querySelector('.compare__scroll-btn-right');
const scrollBtnLeft = document.querySelector('.compare__scroll-btn-left');
const gridMask = document.querySelector('.compare__grid-mask-blur');
let progressBar = document.querySelector('.compare__scroll-progress-bar');
const scroll = document.querySelector('.compare__scroll');

var DesktopCompareMedia = window.matchMedia('(max-width: 1260px)');
var TwoProductCompareMedia = window.matchMedia('(max-width: 692px)');
var ThreeProductCompareMedia = window.matchMedia('(max-width: 931px)');
var FoutProductCompareMedia = window.matchMedia('(max-width: 1173px)');
let quantityProductCompare;
switch (emptyCellCount) {
  case 0:
    {
      quantityProductCompare = function fourProductCompare() {
        if (FoutProductCompareMedia.matches) {
          grid.style.overflow = 'scroll';
          gridMask.style.display = 'block';
          scroll.style.display = 'flex';
        } else {
          grid.style.overflow = 'scroll';
          scroll.style.display = 'none';
          gridMask.style.display = 'none';
        }
      };
    }
    break;

  case 1:
    {
      quantityProductCompare = function threeProductCompare() {
        if (DesktopCompareMedia.matches) {
          grid.style.overflow = 'hidden';
        }
        if (ThreeProductCompareMedia.matches) {
            grid.style.gridTemplateColumns = '168px repeat(3, 240px)';
          emptyCells.forEach((cell) => (cell.style.display = 'none'));
          scroll.style.display = 'flex';
          grid.style.overflow = 'scroll';
          gridMask.style.display = 'block';
        } else {
          emptyCells.forEach((cell) => (cell.style.display = 'block'));
          scroll.style.display = 'none';
          grid.style.overflow = 'hidden';
          gridMask.style.display = 'none';
        }
      };
    }
    break;
  case 2:
    {
      quantityProductCompare = function twoProductCompare() {
        if (DesktopCompareMedia.matches) {
          grid.style.overflow = 'hidden';
        }

        if (TwoProductCompareMedia.matches) {
               grid.style.gridTemplateColumns = '168px repeat(2, 240px)';
          emptyCells.forEach((cell) => (cell.style.display = 'none'));
          scroll.style.display = 'flex';
      
          grid.style.overflow = 'scroll';
          gridMask.style.display = 'block';
        } else {
               grid.style.gridTemplateColumns = '168px repeat(4, 240px)';
          emptyCells.forEach((cell) => (cell.style.display = 'block'));
          scroll.style.display = 'none';
          grid.style.overflow = 'hidden';
          gridMask.style.display = 'none';
        }
      };
    }
    break;
  default:
    break;
}

quantityProductCompare();
window.addEventListener('resize', quantityProductCompare);

scrollBtnLeft.addEventListener('click', (e) => {
  scrollBtnLeft.style.pointerEvents = 'none';
  scrollBtnRight.style.pointerEvents = 'none';
  sideScroll(grid, 'left', 20, 500, 15);
});
scrollBtnRight.addEventListener('click', (e) => {
  scrollBtnLeft.style.pointerEvents = 'none';
  scrollBtnRight.style.pointerEvents = 'none';
  sideScroll(grid, 'right', 20, 500, 15);
});

grid.addEventListener('scroll', (event) => {
  let scrolled =
    (grid.scrollLeft / (grid.scrollWidth - grid.clientWidth)) * 100;
  progressBar.style.width = scrolled + '%';
  if (scrolled == 0) {
    scrollBtnLeft.classList.add('compare__scroll-btn--disabled');
  } else {
    scrollBtnLeft.classList.remove('compare__scroll-btn--disabled');
  }

  if (scrolled == 100) {
    scrollBtnRight.classList.add('compare__scroll-btn--disabled');
    gridMask.classList.add('compare__grid-mask-blur--disabled');
  } else {
    scrollBtnRight.classList.remove('compare__scroll-btn--disabled');
    gridMask.classList.remove('compare__grid-mask-blur--disabled');
  }
});

function sideScroll(element, direction, speed, distance, step) {
  scrollAmount = 0;
  var slideTimer = setInterval(function () {
    if (direction == 'left') {
      element.scrollLeft -= step;
    } else {
      element.scrollLeft += step;
    }
    scrollAmount += step;
    if (scrollAmount >= distance) {
      scrollBtnLeft.style.pointerEvents = 'auto';
      scrollBtnRight.style.pointerEvents = 'auto';
      window.clearInterval(slideTimer);
    }
  }, speed);
}


setCookieFavorite(
  '.compare__grid-btn-remove',
  '.compare__grid-price',
  'wordpress_list_compare',
);