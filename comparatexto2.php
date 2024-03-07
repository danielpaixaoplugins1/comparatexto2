<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Comparador de Textos e Códigos Avançado</title>
<style>
  .container {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-top: 20px;
  }
  textarea {
    margin: 10px;
    width: 600px;
    height: 200px;
  }
  #resultado {
    margin-top: 20px;
    white-space: pre-wrap;
  }
  .adicionado { background-color: lightgreen; }
  .removido { background-color: lightcoral; }
</style>
</head>
<body>

<div class="container">
  <textarea id="texto1" placeholder="Cole o primeiro texto ou código aqui..."></textarea>
  <textarea id="texto2" placeholder="Cole o segundo texto ou código aqui..."></textarea>
  <button id="compararBtn">Comparar</button>
  <div id="resultado"></div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/diff_match_patch/20121119/diff_match_patch.js"></script>
<script>
document.getElementById('compararBtn').addEventListener('click', function() {
  var dmp = new diff_match_patch();
  var texto1 = document.getElementById('texto1').value;
  var texto2 = document.getElementById('texto2').value;
  var diffs = dmp.diff_main(texto1, texto2);
  dmp.diff_cleanupSemantic(diffs);

  var display = document.getElementById('resultado');
  display.innerHTML = '';
  diffs.forEach(function(part){
    var span = document.createElement('span');
    span.appendChild(document.createTextNode(part[1]));
    if (part[0] === 1) {
      span.className = 'adicionado';
    } else if (part[0] === -1) {
      span.className = 'removido';
    }
    display.appendChild(span);
  });
});
</script>

</body>
</html>
