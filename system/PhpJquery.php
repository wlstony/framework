<?php
//暂时不支持没有结束标记的标签
class PHPJquery{
    private $_html;
    private $_punctuation;
    private $_w_s_p;
    private $_w_s_p_e_4;
    function __construct($html) {
        $this->_html = $html;
        $this->_punctuation = '"' . "'";
        $this->_w_s_p = '\s\w' . $this->_punctuation;
        $this->_w_s_p_e_4 =  $this->_w_s_p . '=\$';
    }    

    //匹配html嵌套时的情况, 未能想到好的方法解决, .net的解决思路如下(php的待日后完善)
    /*思路:先匹配最前面的起始标签，假设是div（<div），然后一旦遇到嵌套div，就“压入堆栈”，然后一遇到
     *div结束标签了，就“弹出堆栈”。如果遇到结束标签的时候，堆栈里面已经没有东西了，那么匹配结束，此结
     *束标签为正确的闭合标签.*/
    //该处使用递归解决
    //方法中的正则不包括一些少数字符, id不能包括特殊字符
    function getElementById($id, $pattern='', $node='') {
        if(! $id) return new Node('', '');
        $pattern = $pattern ? : strtr('/<(?<tag>[\w]*)[%wsp-:;]*[iI][dD]%b=%b[%punc][\s]*' . $id . '[\s]*[%punc][%wsp-:;]*>[\w\W]*?(?:<%b\/%b\k<tag>%b>)/', array(
                '%wsp' => $this->_w_s_p_e_4,
                '%punc' => $this->_punctuation,
                '%b' => '[\s]*?'
        ));
        preg_match($pattern, $this->_html, $matches);
        
        if(! $matches) return $node ? $node : new Node('', '');    
        
        $ele_html = $matches[0];
        $tagName = $matches['tag'];
        
        $open_pattern = strtr('/<[\s]*?%tag/', array(
                '%tag' => $tagName
        ));

        $end_pattern = strtr('/<[\s]*?\/[\s]*?%tag/', array(
                '%tag' => $tagName
        ));

        preg_match_all($open_pattern, $ele_html, $open_matches);
        preg_match_all($end_pattern, $ele_html, $end_matches);
        if(($open_matches && ! $end_matches) ||
            ($open_matches && $end_matches && count($open_matches[0]) > count($end_matches[0])) ) {
            $n_pattern = strtr('/<(?<tag>%b%tag%b)[%wsp-:;]*[iI][dD]%b=%b[%punc][\s]*' . $id . '[\s]*[%punc][%wsp-:;]*>' . '(?:[\w\W]*?<%b\/%b%tag%b>){%count}/', array(
                        '%wsp' => $this->_w_s_p_e_4,
                        '%punc' => $this->_punctuation,
                        '%b' => '[\s]*?',
                        '%tag' => $tagName,
                        '%count' => count($open_matches[0])
            
            ));
            $n_node = new Node($tagName, $ele_html);
            return $this->getElementById($id, $n_pattern, $n_node);
        }
        else {
            return new Node($tagName, $ele_html);     
       }
        
    }
    
    function getElementsByAttribute($attr, $value, $pattern='', $node='') {
        static $nodeArr = Array();
       if(! $attr) return new Node('', '');  
        $pattern = $pattern ? : strtr('/<(?<tag>[\w]*)[%wsp-:;]*%attr%b=%b[%punc]%b%value%b[%punc][%wsp-:;]*>[\w\W]*?(?:<%b\/%b\k<tag>%b>)/', array(
                '%wsp' => $this->_w_s_p_e_4,
                '%punc' => $this->_punctuation,
                '%b' => '[\s]*?',
                '%attr' => $attr,
                '%value' => $value
        ));
        preg_match_all($pattern, $this->_html, $matches);
       
       if(! $matches) return $node ? $node : new Node('', '');

        $tagName = ''; 
        $ele_html = '';

        foreach($matches[0] as $mk => $match) {
            $tagName = $matches['tag'][$mk];
            $ele_html = $match;
             $open_pattern = strtr('/<[\s]*?%tag/', array(
                                        '%tag' => $tagName
                                     ));

             $end_pattern = strtr('/<[\s]*?\/[\s]*?%tag/', array(
                                        '%tag' => $tagName
                                         ));
             preg_match_all($open_pattern, $ele_html, $open_matches);
             preg_match_all($end_pattern, $ele_html, $end_matches);
             if(($open_matches && ! $end_matches) ||
                ($open_matches && $end_matches && count($open_matches[0]) > count($end_matches[0])) ) {
                $n_pattern = strtr('/<(?<tag>%b%tag%b)[%wsp-:;]*%attr%b=%b[%punc]%b%value%b[%punc][%wsp-:;]*>' . '(?:[\w\W]*?<%b\/%b%tag%b>){%count}/', array(
                                      '%wsp' => $this->_w_s_p_e_4,
                                      '%punc' => $this->_punctuation,
                                      '%b' => '[\s]*?',
                                      '%tag' => $tagName,
                                      '%attr' => $attr,
                                      '%value'=> $value,
                                      '%count' => count($open_matches[0])
                                                                                                                                                  ));
                 $n_node = new Node($tagName, $ele_html);
                 $this->getElementsByAttribute($attr,$value, $n_pattern, $n_node);
             }
             else {
                 $nodeArr[] = new Node($tagName, $ele_html);
            }
       }

       return $nodeArr;

  }

}

//使用phpjquery提取出需要的字符串, 使用node对提取后的字符串编辑
class Node{
    var $_tagName;
    var $_innerHtml;
    var $_innerText;

    function __construct($tagName, $innerHtml) { 
       $this->_tagName = $tagName;
       $this->_innerHtml = $innerHtml;
       $this->_innerText = strip_tags($innerHtml);
    }

    function getInnerText($html) {
        if(! $html) return '';
        return strip_tags($html);    
    } 
    
    
}
