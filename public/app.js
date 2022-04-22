document.addEventListener( 'keydown', ( event ) => {

  const currentInput = document.activeElement;
  const currentTd = currentInput.parentNode;
  const currentTr = currentTd.parentNode;
  const index = Array.from(currentTr.children).indexOf(currentTd);

  switch (event.key) {
    case "ArrowLeft":
        // Left pressed
        currentTd.previousElementSibling.getElementsByTagName('input')[2].focus();
        break;
    case "ArrowRight":
        // Right pressed
        currentTd.nextElementSibling.getElementsByTagName('input')[2].focus();
        break;
    case "ArrowUp":
        // Up pressed
        Array.from( currentTr.previousElementSibling.children )[index].getElementsByTagName('input')[2].focus();
        break;
    case "ArrowDown":
        // Down pressed
        Array.from( currentTr.nextElementSibling.children )[index].getElementsByTagName('input')[2].focus();
        break;
  }
} )