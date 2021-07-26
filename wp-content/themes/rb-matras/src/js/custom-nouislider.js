///RANGE SLIDER FILTER PRICE
const pricerangeSlider = document.getElementById('price-range-slider');
if (pricerangeSlider) {
  noUiSlider.create(pricerangeSlider, {
    start: [0, 258313],
    connect: true,
    step: 1,
    range: {
      min: [0],
      max: [258313],
    },
  });
  const pricerangeInput0 = document.getElementById(
    'price-range-slider-input-0',
  );
  const pricerangeInput1 = document.getElementById(
    'price-range-slider-input-1',
  );
  const pricerangeText0 = document.getElementById('price-range-slider-text-0');
  const pricerangeText1 = document.getElementById('price-range-slider-text-1');
  priceinputs = [pricerangeInput0, pricerangeInput1];
  pricetexts = [pricerangeText0, pricerangeText1];
  pricerangeSlider.noUiSlider.on('update', function (values, handle) {
    priceinputs[handle].value = Math.round(values[handle]);
    pricetexts[handle].innerHTML = Math.round(values[handle]);
  });
  const setPriceRangeSlider = (i, value) => {
    let arr = [null, null];
    arr[i] = value;
    pricerangeSlider.noUiSlider.set(arr);
  };
  priceinputs.forEach((el, index) => {
    el.addEventListener('change', (e) => {
      setPriceRangeSlider(index, e.currentTarget.value);
    });
  });
}
///RANGE SLIDER FILTER WIDTH
const widthrangeSlider = document.getElementById('width-range-slider');
if (widthrangeSlider) {
  noUiSlider.create(widthrangeSlider, {
    start: [60, 200],
    connect: true,
    step: 1,
    range: {
      min: [60],
      max: [200],
    },
  });
  const widthrangeInput0 = document.getElementById(
    'width-range-slider-input-0',
  );
  const widthrangeInput1 = document.getElementById(
    'width-range-slider-input-1',
  );
  const widthrangeText0 = document.getElementById('width-range-slider-text-0');
  const widthrangeText1 = document.getElementById('width-range-slider-text-1');
  widthinputs = [widthrangeInput0, widthrangeInput1];
  widthtexts = [widthrangeText0, widthrangeText1];
  widthrangeSlider.noUiSlider.on('update', function (values, handle) {
    widthinputs[handle].value = Math.round(values[handle]);
    widthtexts[handle].innerHTML = Math.round(values[handle]);
  });
  const setWidthRangeSlider = (i, value) => {
    let arr = [null, null];
    arr[i] = value;
    widthrangeSlider.noUiSlider.set(arr);
  };
  //widthrangeSlider.setAttribute('disabled', true);
  widthinputs.forEach((el, index) => {
    el.addEventListener('change', (e) => {
      setWidthRangeSlider(index, e.currentTarget.value);
    });
  });
}

///RANGE SLIDER FILTER HEIGHT
const heightrangeSlider = document.getElementById('height-range-slider');
if (heightrangeSlider) {
  noUiSlider.create(heightrangeSlider, {
    start: [120, 200],
    connect: true,
    step: 1,
    range: {
      min: [120],
      max: [200],
    },
  });
  const heightrangeInput0 = document.getElementById(
    'height-range-slider-input-0',
  );
  const heightrangeInput1 = document.getElementById(
    'height-range-slider-input-1',
  );

  const heightrangeText0 = document.getElementById(
    'height-range-slider-text-0',
  );
  const heightrangeText1 = document.getElementById(
    'height-range-slider-text-1',
  );
  heightinputs = [heightrangeInput0, heightrangeInput1];
  heighttexts = [heightrangeText0, heightrangeText1];
  heightrangeSlider.noUiSlider.on('update', function (values, handle) {
    heightinputs[handle].value = Math.round(values[handle]);
    heighttexts[handle].innerHTML = Math.round(values[handle]);
  });
  const setheightRangeSlider = (i, value) => {
    let arr = [null, null];
    arr[i] = value;
    heightrangeSlider.noUiSlider.set(arr);
  };

  heightinputs.forEach((el, index) => {
    el.addEventListener('change', (e) => {
      setheightRangeSlider(index, e.currentTarget.value);
    });
  });
}
