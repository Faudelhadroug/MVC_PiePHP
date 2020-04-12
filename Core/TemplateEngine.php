<?php

namespace Core;

class TemplateEngine 
{
    public static function replace($view)
    {
        $patternVariable = '/\{\{(.*?)\}\}/';
        $patternBalise = '/<(.*)>/';
        $pattern = [$patternBalise, $patternVariable, '/@foreach(.*)\)/', '/@endforeach/', '/@isset(.*)\)/', '/@endisset/', '/@empty(.*)\)/', '/@endempty/', '/@if(.*)\)/', '/\@elseif(.*)\)/', '/\@else/', '/\@endif/'];
        $replace = ['echo "<$1>";', "echo htmlentities($1);", 'foreach$1){', '}', "if(isset$1)){", '}', "if(empty$1)){", '}', 'if $1 ) {', '} else if $1 ) {', '} else {', '}'];
        $view = preg_replace($pattern, $replace, $view);
        return $view;
    }
}