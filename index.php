<?php

use dsl\executor\DslInterpreter;

require('./autoload.php');

?><html>
<head><title>Script Sandbox</title>
<style>
    textarea {
        width: 100%;
        height: 50%;
    }

</style></head>
<body>


</body></html>
<h1>Script Sandbox</h1>
<p>Script sandbox for PHP. The syntax is a subset of Javascript. The interpreter is supporting functions, full arithmetic calculations, for-loops, if-else statements.
</p>
    <?php $code = $_POST['code'] ?: <<<DEF
// Script sandbox
// Feel free to write some code here....
write( "test" );

/**
*/
function name() {
        return "something";
}
DEF
   ; ?>

<legend title="Script output">
<pre>
    <?php
    try {
        error_reporting( E_ALL );
        $interpreter = new DslInterpreter( DslInterpreter::FLAG_SHOW_ERROR + DslInterpreter::FLAG_SHOW_TRACE );
        $interpreter->runCode( $code );
        echo htmlentities( $interpreter->getOutput() );
    } catch( Exception $e ) {
        // should never happen because the interpreter catches all.
        echo "Unexcepted error while running the script: \n".htmlentities( $e->getMessage() )."\n";
    }
    ?>
</pre></legend>
<form action="./" method="POST"><textarea name="code"><?php echo htmlentities( $code ) ?>
</textarea>
<input type="submit" value="Execute code"/>
</form>
