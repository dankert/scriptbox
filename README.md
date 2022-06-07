# Script Sandbox for PHP

## Overview

This is a script interpreter for PHP. Custom code is parsed and interpreted in a sandbox.

The code syntax is similar to [Javascript](https://developer.mozilla.org/en-US/docs/Web/JavaScript). More precisely, it is a subset of Javascript.

## History 

It was written for the [OpenRat CMS](http://www.openrat.de) and is maintained there.


## Details

Scriptbox is an in-memory script interpreter written in PHP. The scripts are interpreted directly in the syntax tree and are **not** transpiled to PHP code.

A script is running in its sandbox, but it may call functions in your PHP code if you provide appropriate classes (see below).

It consists of a lexer, a syntax parser and an interpreter.

The scripts may be used as a [domain specific language (DSL)](https://en.wikipedia.org/wiki/Domain-specific_language) in your PHP application.


## Usage

There is the `dsl\executor\DslInterpreter` class to run your code:

    $interpreter = new DslInterpreter();
    $interpreter->runCode( $code );

### get output

For getting the standard output, simply call `getOutput()`:

    $interpreter = new DslInterpreter();
    $interpreter->runCode( $code );
    $output = $interpreter->getOutput() ); // get the output

### add context

you may add custom objects to the calling context

    $interpreter = new DslInterpreter();
    $interpreter->addContext( [ 'mycontext'=> new MyContextObject() ]  );
    $interpreter->runCode( $code );

Your class `MyContextObject` must implement `dsl\context\DslObject`,then your code may contain

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

    write( "this is a 'string'" );  // writes to standard out
    write( 'this is a "string"' );  // writes to standard out 
    

### variables

variables and string concatenation:

    age = 18;
    write("my age is " + age );

variables *may* be initialized with `let`,`var` or `const` but this is optional:

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
   
    write( 1 + 2 * 3 ); // this resolves to 7 because of the operator priority

### arrays and for loops

    animals = Array.of('lion', 'ape', 'fish');

    for( animal of animals )
        write( animal + " is an animal." );


### object properties

    write( "PI is " + Math.PI );

    

## Template script

Remember Smarty and Twig? Yes, but both have their strange syntax. Check out this template parser with a JSP-like syntax:

    <html>
    <body>
    <% age = 12; %>
    Next year your age is <%= (age+1) %></br>


### Usage

    // Parse the template, this will create a plain script
    $templateParser = new DslTemplate();
    $templateParser->parseTemplate($src);

    // That's all. Lets start the interpreter
    $executor = new DslInterpreter();
    $executor->runCode($templateParser->script);
    echo( $executor->getOutput() ); // get the output


## Unsupported

- There is NO support for creating classes or objects.
- Due to the request-based operation of the PHP interpreter there is no possibility for asynchronous methods like `async` or `await`.
- No try/catch
- No `window`, `document` or `navigator` objects

## FAQ

_Does it generate PHP code?_

No. The Interpreter works in memory. There is no way to create PHP code, even if it would be possible to implement.

_Is it slow?_

Yes, maybe, because there is no cache and no compilation to native PHP code. But this scriptbox targets content management systems which have their own caching.

_Why did you do this?_

Because it was possible ;) And I needed a sandboxed DSL (domain specific language) for my CMS.