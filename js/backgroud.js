// Array de URLs das imagens
var images = [
    "https://www.acessepiaui.com.br/images/noticias/2662/litoral.jpg",
    "https://f.i.uol.com.br/fotografia/2018/06/13/15289230125b218384ad128_1528923012_3x2_md.jpg",
    "https://www.tce.pi.gov.br/wp-content/uploads/2016/10/litoral_piauiense.jpg",
    "https://www.demervallobao.pi.leg.br/institucional/fotos/ponte-estaiada-teresina-piaui-1340048939.jpg/image"
  ];

  var currentIndex = 0;
  var backgroundElement = document.getElementById("background");
  var fadeBackgroundElement = document.querySelector("#background .fade-background");

  function fadeOut() {
    // Diminui gradualmente a opacidade do elemento "fadeBackgroundElement"
    var currentOpacity = 1;
    var fadeEffect = setInterval(function () {
      if (currentOpacity > 0) {
        currentOpacity -= 0.05;
        fadeBackgroundElement.style.opacity = currentOpacity;
      } else {
        clearInterval(fadeEffect);
        changeImage();
      }
    }, 50);
  }

  function fadeIn() {
    // Aumenta gradualmente a opacidade do elemento "fadeBackgroundElement"
    var currentOpacity = 0;
    var fadeEffect = setInterval(function () {
      if (currentOpacity < 1) {
        currentOpacity += 0.05;
        fadeBackgroundElement.style.opacity = currentOpacity;
      } else {
        clearInterval(fadeEffect);
      }
    }, 50);

    // Atualiza o índice para a próxima imagem
    currentIndex = (currentIndex + 1) % images.length;

    // Define o tempo de espera entre as imagens (em milissegundos)
    setTimeout(fadeOut, 10000);
  }

  function changeImage() {
    // Altera a imagem de fundo para a próxima imagem
    backgroundElement.style.backgroundImage = "url('" + images[currentIndex] + "')";

    // Redefine a opacidade do elemento "fadeBackgroundElement" para 1 antes de iniciar a transição de fade
    fadeBackgroundElement.style.opacity = 1;

    // Chama a função para iniciar a transição de fade
    fadeIn();
  }

  // Inicia a rotação do plano de fundo
  changeImage();
