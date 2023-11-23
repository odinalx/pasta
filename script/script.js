function autocompletionaller1() {
    var recherche = document.getElementById('aller1').value;
    if (recherche.length == 0) { 
        document.getElementById('resultataller1').innerHTML = "";
        
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('resultataller1').innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "getaller.php?q=" + recherche, true);
        xmlhttp.send();
    }
}
function autocompletionaller2() {
  var recherche = document.getElementById('aller2').value;
  if (recherche.length == 0) { 
      document.getElementById('resultataller2').innerHTML = "";
      
  } else {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
              document.getElementById('resultataller2').innerHTML = this.responseText;
          }
      };
      xmlhttp.open("GET", "getaller.php?q=" + recherche, true);
      xmlhttp.send();
  }
}
function autocompletionaller3() {
  var recherche = document.getElementById('aller3').value;
  if (recherche.length == 0) { 
      document.getElementById('resultataller3').innerHTML = "";
      
  } else {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
              document.getElementById('resultataller3').innerHTML = this.responseText;
          }
      };
      xmlhttp.open("GET", "getaller.php?q=" + recherche, true);
      xmlhttp.send();
  }
}
function autocompletionstore() {
  var recherche = document.getElementById('store').value;
  if (recherche.length == 0) { 
      document.getElementById('resultatstore').innerHTML = "";
      
  } else {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
              document.getElementById('resultatstore').innerHTML = this.responseText;
          }
      };
      xmlhttp.open("GET", "getstore.php?q=" + recherche, true);
      xmlhttp.send();
  }
}
function autocompletionbrand() {
  var recherche = document.getElementById('brand').value;
  if (recherche.length == 0) { 
      document.getElementById('resultatbrand').innerHTML = "";
      
  } else {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
              document.getElementById('resultatbrand').innerHTML = this.responseText;
          }
      };
      xmlhttp.open("GET", "getbrand.php?q=" + recherche, true);
      xmlhttp.send();
  }
}





//bouton et menu burger
const containerSlot = document.querySelector(".slot");
const btnConfettis = document.querySelector(".btn-confettis");
const emojis = ["🍝", "👍", "🍝", "🤌"];

btnConfettis.addEventListener("click", fiesta);

function fiesta() {

  if(isTweening()) return;

  for (let i = 0; i < 50; i++) {
    const confetti = document.createElement("div");
    confetti.innerText = emojis[Math.floor(Math.random() * emojis.length)];
    containerSlot.appendChild(confetti);
  }

  animateConfettis();
}

function animateConfettis() {

  const TLCONF = gsap.timeline();

  TLCONF.to(".slot div", {
    y: "random(-100,100)",
    x: "random(-100,100)",
    z: "random(0,1000)",
    rotation: "random(-90,90)",
    duration: 1,
  })
    .to(".slot div", { autoAlpha: 0, duration: 0.3 }, "-=0.2")
    .add(() => {
      containerSlot.innerHTML = "";
    });
}

function isTweening(){
  return gsap.isTweening('.slot div');
}

const mobilemenu = document.querySelector('.mobile-menu');
document.querySelector('.hamburger').addEventListener('click', function () {
    this.classList.toggle('is-active');
    mobilemenu.classList.toggle('is-open');
}); 