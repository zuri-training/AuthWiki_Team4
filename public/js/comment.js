var btn1 = document.querySelector('#blue');
var btn2 = document.querySelector('#red');

btn1.addEventListener('click', function() {
  
    if (btn2.classList.contains('red')) {
      btn2.classList.remove('red');
    } 
  this.classList.toggle('blue');
  
});

btn2.addEventListener('click', function() {
  
    if (btn1.classList.contains('blue')) {
      btn1.classList.remove('blue');
    } 
  this.classList.toggle('red');
  
});



/*============= second reply  ===============*/

var btnSecond1 = document.querySelector('#blue-1');
var btnSecond2 = document.querySelector('#red-1');

btnSecond1.addEventListener('click', function() {
  
    if (btnSecond2.classList.contains('red-1')) {
      btnSecond2.classList.remove('red-1');
    } 
  this.classList.toggle('blue-1');
  
});

btnSecond2.addEventListener('click', function() {
  
    if (btnSecond1.classList.contains('blue-1')) {
      btnSecond1.classList.remove('blue-1');
    } 
  this.classList.toggle('red-1');
  
});



/*============= third reply  ===============*/

var btnThird1 = document.querySelector('#blue-2');
var btnThird2 = document.querySelector('#red-2');

btnThird1.addEventListener('click', function() {
  
    if (btnThird2.classList.contains('red-2')) {
      btnThird2.classList.remove('red-2');
    } 
  this.classList.toggle('blue-2');
  
});

btnThird2.addEventListener('click', function() {
  
    if (btnThird1.classList.contains('blue-2')) {
      btnThird1.classList.remove('blue-2');
    } 
  this.classList.toggle('red-2');
  
});



/*============= Fourth reply  ===============*/

var btnFourth1 = document.querySelector('#blue-3');
var btnFourth2 = document.querySelector('#red-3');

btnFourth1.addEventListener('click', function() {
  
    if (btnFourth2.classList.contains('red-3')) {
      btnFourth2.classList.remove('red-3');
    } 
  this.classList.toggle('blue-3');
  
});

btnFourth2.addEventListener('click', function() {
  
    if (btnFourth1.classList.contains('blue-3')) {
      btnFourth1.classList.remove('blue-3');
    } 
  this.classList.toggle('red-3');
  
});


/*============= Fifth reply  ===============*/

var btnFifth1 = document.querySelector('#blue-4');
var btnFifth2 = document.querySelector('#red-4');

btnFifth1.addEventListener('click', function() {
  
    if (btnFifth2.classList.contains('red-4')) {
      btnFifth2.classList.remove('red-4');
    } 
  this.classList.toggle('blue-4');
  
});

btnFifth2.addEventListener('click', function() {
  
    if (btnFifth1.classList.contains('blue-4')) {
      btnFifth1.classList.remove('blue-4');
    } 
  this.classList.toggle('red-4');
  
});
