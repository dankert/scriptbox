<?php

use dsl\executor\DslInterpreter;

require('./autoload.php');

?><html>
<head><title>Scriptbox</title>
<style>
    textarea {
        width: 100%;
        height: 50%;
    }

</style></head>
<body>


<h1>Scriptbox</h1>
<p>Scriptbox is a Script sandbox for PHP.</p><p>The syntax is a subset of Javascript.<br/> The interpreter is supporting functions, full arithmetic calculations, for-loops, if-else statements.
</p>
    <?php $code = @$_POST['code'] ?: <<<DEF
// Script sandbox
// Feel free to write some code here....
//write( "test" );

/**
 * functions without parameters
 */
function something() {
        return "something";
}

write( "I wrote " + something() + "\\n" );

/**
 * functions with parameters
 */
function sayName( name ) {
  write( "your name is " + name + "\\n" );
}

sayName("Alice");

// Arithmetic magic 
write( "Arithmetic magic: 1 + 2 * (3 + 2) = " );
write(  1 + 2 * (3 + 2)  );
write( "\\n" );


// lists...
names = Array.of("Alice","Bob",something() );

for( name of names ) {
   write( "A name: " + name + "\\n");

   // some condition...
   if   ( name == "Alice" )
      write( "Hello Alice, nice to meet you! "+"\\n");
   else
      write( "Your are not Alice"+"\\n");
}
DEF
   ; ?>

<fieldset>
<legend>Output</legend>
<pre><?php
    try {
        error_reporting( E_ALL );
        $interpreter = new DslInterpreter( DslInterpreter::FLAG_SHOW_ERROR  );
        $interpreter->runCode( $code );
        echo htmlentities( $interpreter->getOutput() );
    } catch( Exception $e ) {
        // should never happen because the interpreter catches all.
        echo "Unexcepted error while running the script: \n".htmlentities( $e->getMessage() )."\n";
    }
    ?>
</pre>
</fieldset>
    <fieldset>
        <legend>Source</legend>
        <form action="./" method="POST">
            <textarea name="code" rows="50" style="border:0;"><?php echo htmlentities( $code ) ?></textarea>
            <input type="submit" value="Execute" />
        </form>
    </fieldset>

</body></html>