<?php

// Escapes HTML for output
// Since in this case we're going to print out a $_POST variable to the HTML, 
// we need to properly convert the HTML characters, which will aid in preventing XSS attacks.

function escape($html) {
  return htmlspecialchars($html, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
}