# Script Sandbox

This is a script interpreter for PHP. Custom code is parsed and interpreted in a sandbox.

It was written for the [OpenRat CMS](http://www.openrat.de) and is maintained there.



## Using

There is the `dsl\executor\DslInterpreter` class to run your code:

    $interpreter = new DslInterpreter();
    $interpreter->runCode( $code );

### get output

For getting the standard output, simple call `getOutput()`:

    $interpreter = new DslInterpreter();
    $interpreter->runCode( $code );
    $output = $interpreter->getOutput() ); // get the output

### add context

you may add custom objects to the calling context

    $interpreter = new DslInterpreter();
    $interpreter->addContext( [ 'mycontext'=> new MyContextObject() ]  );
    $interpreter->runCode( $code );

Your class `MyContextObject` must implement `dsl\context\DslObject`,then your code my contain

    mycontext.method();

### get return value

    $interpreter = new DslInterpreter();
    $returnValue = $interpreter->runCode( $code );

## Syntax

The language syntax is a subset of javascript.

## Features

### comments

single line comments like

    // this is a comment

and multiline commens like

    /**
     * this is a comment
     */

are supported


### text

    write( "this is a 'string'" );
    write( 'this is a "string"' ); 
    

### variables

variables and string concatenation:

    age = 18;
    write("my age is " + age );

variables may be initialized with `let`,`var` or `const` but this is optional:

    let age = 18; // "let" is optional and completely ignored
    write("my age is " + age );

every variable is "block scoped".


### function scope

variables are valid for the current block.

    age = 18;

    function add() {
        age = age + 1;
        write( "next year, you are " + age ); // 19
    }
    add();

    write( "but this year you are " + age ); // 18


### function calls

Example

    write( "powered by " + name() );

    function name() {
        return "script sandbox";
    {


### if / else

    age = 17;
    if   ( age < 18 )
        write( "you are under 18" );
    else {
        write( "you are already 18" );
        write( "you are allowed to enter" );
    }

### full arithmetic calculations
   
    write( 1 + 2 * 3 ); // this resolves to 7 because of the priority

### arrays and for loops

    animals = Array.of('lion', 'ape', 'fish');

    for( animal of animals )
        write( animal + " is an animal." );


### object properties

    write( "PI is " + Math.PI );


## Unsupported

there is NO support for
- creating classes or objects
- async, await