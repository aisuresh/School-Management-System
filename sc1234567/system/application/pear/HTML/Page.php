<?php
/* vim: set expandtab tabstop=4 shiftwidth=4: */
// +----------------------------------------------------------------------+
// | PHP Version 4                                                        |
// +----------------------------------------------------------------------+
// | Copyright (c) 1997 - 2003 The PHP Group                              |
// +----------------------------------------------------------------------+
// | This source file is subject to version 3.0 of the PHP license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available at through the world-wide-web at                           |
// | http://www.php.net/license/3_0.txt.                                  |
// | If you did not receive a copy of the PHP license and are unable to   |
// | obtain it through the world-wide-web, please send a note to          |
// | license@php.net so we can mail you a copy immediately.               |
// +----------------------------------------------------------------------+
// | Authors: Adam Daniel <adaniel1@eesus.jnj.com>                        |
// |          Klaus Guenther <klaus@capitalfocus.org>                     |
// +----------------------------------------------------------------------+
//
// $Id: Page.php,v 1.29 2003/11/03 07:38:40 thesaur Exp $

require_once 'PEAR.php';
require_once 'HTML/Common.php';
// HTML/Page/Doctypes.php is required in _getDoctype()
// HTML/Page/Namespaces.php is required in _getNamespace()

/**
 * Base class for XHTML pages
 *
 * This class handles the details for creating a properly constructed XHTML page.
 * Page caching, stylesheets, client side script, and Meta tags can be
 * managed using this class.
 * 
 * The body may be a string, object, or array of objects or strings. Objects with
 * toHtml() and toString() methods are supported.
 * 
 *
 * XHTML Examples:
 * ---------------
 *
 * Simplest example:
 * -----------------
 * <code>
 * // the default doctype is XHTML 1.0 Transitional
 * // All doctypes and defaults are set in HTML/Page/Doctypes.php
 * $p = new HTML_Page();
 *
 * //add some content
 * $p->addBodyContent("<p>some text</p>");
 *
 * // print to browser
 * $p->display();
 * </code>
 * 
 * Complex XHTML example:
 * ----------------------
 * <code>
 * // The initializing code can also be in in the form of an HTML
 * // attr="value" string.
 * // Possible attributes are: charset, mime, lineend, tab, doctype, namespace, language and cache
 * 
 * $p = new HTML_Page(array (
 *
 *                          // Sets the charset encoding
 *                          // utf-8 is default
 *                          'charset'  => 'utf-8',
 *
 *                          // Sets the line end character
 *                          // unix (\n) is default
 *                          'lineend'  => 'unix',
 *
 *                          // Sets the tab string for autoindent
 *                          // tab (\t) is default
 *                          'tab'  => '  ',
 *
 *                          // This is where you define the doctype
 *                          'doctype'  => "XHTML 1.0 Strict",
 *
 *                          // Global page language setting
 *                          'language' => 'en',
 *
 *                          // If cache is set to true, the browser may
 *                          // cache the output. Else 
 *                          'cache'    => 'false'
 *                          ));
 *
 * // Here we go
 *
 * // Set the page title
 * $p->setTitle("My page");
 * 
 * // Add optional meta data
 * $p->setMetaData("author", "My Name");
 * 
 * // Put something into the body
 * $p->addBodyContent("<p>some text</p>");
 *
 * // If at some point you want to clear the page content
 * // and output an error message, you can easily do that
 * // See the source for {@link toHtml} and {@link _getDoctype}
 * // for more details
 * if ($error) {
 *     $p->setTitle("Error!");
 *     $p->setBodyContent("<p>Houston, we have a problem: $error</p>");
 *     $p->display();
 *     die;
 * } // end error handling
 *
 * // print to browser
 * $p->display();
 * // output to file
 * $p->toFile('example.html');
 * </code>
 * 
 * Simple XHTML declaration example:
 * <code>
 * $p = new HTML_Page();
 * // An XHTML compliant page (with title) is automatically generated
 *
 * // This overrides the XHTML 1.0 Transitional default
 * $p->setDoctype('XHTML 1.0 Strict');
 * 
 * // Put some content in here
 * $p->addBodyContent("<p>some text</p>");
 *
 * // print to browser
 * $p->display();
 * </code>
 * 
 *
 * HTML examples:
 * --------------
 *
 * HTML 4.01 example:
 * ------------------
 * <code>
 * $p = new HTML_Page('doctype="HTML 4.01 Strict"');
 * $p->addBodyContent = "<p>some text</p>";
 * $p->display();
 * </code>
 * 
 * nuke doctype declaration:
 * -------------------------
 * <code>
 * $p = new HTML_Page('doctype="none"');
 * $p->addBodyContent = "<p>some text</p>";
 * $p->display();
 * </code>
 * 
 * @author       Adam Daniel <adaniel1@eesus.jnj.com>
 * @author       Klaus Guenther <klaus@capitalfocus.org>
 * @package      HTML_Page
 * @version      2.0
 * @since        PHP 4.0.3pl1
 */
class HTML_Page extends HTML_Common {
    
    /**
     * Contains the content of the &lt;body&gt; tag.
     * 
     * @var     array
     * @access  private
     */
    var $_body = array();
    
    /**
     * Controls caching of the page
     * 
     * @var     bool
     * @access  private
     */
    var $_cache = false;
    
    /**
     * Contains the character encoding string
     * 
     * @var     string
     * @access  private
     */
    var $_charset = 'utf-8';
    
    /**
     * Contains the !DOCTYPE definition
     * 
     * @var array
     * @access private
     */
    var $_doctype = array('type'=>'xhtml','version'=>'1.0','variant'=>'transitional');
    
    /**
     * Contains the page language setting
     * 
     * @var     string
     * @access  private
     */
    var $_language = 'en';
    
    /**
     * Array of meta tags
     * 
     * @var     array
     * @access  private
     */
    var $_metaTags = array( 'standard' => array ( 'Generator' => 'PEAR HTML_Page' ) );
    
    /**
     * Document mime type
     * 
     * @var      string
     * @access   private
     */
    var $_mime = 'text/html';
    
    /**
     * Document namespace
     * 
     * @var      string
     * @access   private
     */
    var $_namespace = '';
    
    /**
     * Array of linked scripts
     * 
     * @var      array
     * @access   private
     */
    var $_scripts = array();
    
    /**
     * Array of scripts placed in the header
     * 
     * @var  array
     * @access   private
     */
    var $_script = array();
    
    /**
     * Suppresses doctype
     * 
     * @var     boolean
     * @access  private
     */
    var $_simple = false;
    
    /**
     * Array of included style declarations
     * 
     * @var     array
     * @access  private
     */
    var $_style = array();
    
    /**
     * Array of linked style sheets
     * 
     * @var     array
     * @access  private
     */
    var $_styleSheets = array();
    
    /**
     * HTML page title
     * 
     * @var     string
     * @access  private
     */
    var $_title = '';
    
    /**
     * Defines whether XML prolog should be prepended to XHTML documents
     * 
     * @var  bool
     * @access   private
     */
    var $_xmlProlog = true;
    
    /**
     * Class constructor
     * Possible attributes are:
     * - general options:
     *     - "lineend" => "unix|win|mac" (Sets line ending style; defaults to unix.)
     *     - "tab"     => string (Sets line ending style; defaults to \t.)
     *     - "cache"   => "false|true"
     *     - "charset" => charset string (Sets charset encoding; defaults to utf-8)
     *     - "mime"    => mime encoding string (Sets document mime type; defaults to text/html)
     * - XHTML specific:
     *     - "doctype"  => string (Sets XHTML doctype; defaults to XHTML 1.0 Transitional.)
     *     - "language" => two letter language designation. (Defines global document language; defaults to "en".)
     *     - "namespace"  => string (Sets document namespace; defaults to the W3C defined namespace.)
     * 
     * @param   mixed   $attributes     Associative array of table tag attributes
     *                                  or HTML attributes name="value" pairs
     * @access  public
     */
    function HTML_Page($attributes = array())
    {
        
        if ($attributes) {
            $attributes = $this->_parseAttributes($attributes);
        }
        
        if (isset($attributes['lineend'])) {
            $this->setLineEnd($attributes['lineend']);
        }
        
        if (isset($attributes['charset'])) {
            $this->setCharset($attributes['charset']);
        }
        
        if (isset($attributes['doctype'])){
            if ($attributes['doctype'] == 'none') {
                $this->_simple = true;
            } elseif ($attributes['doctype']) {
                $this->setDoctype($attributes['doctype']);
            }
        }
        
        if (isset($attributes['language'])) {
            $this->setLang($attributes['language']);
        }
        
        if (isset($attributes['mime'])) {
            $this->setMimeEncoding($attributes['mime']);
        }
        
        if (isset($attributes['namespace'])) {
            $this->setNamespace($attributes['namespace']);
        }
        
        if (isset($attributes['tab'])) {
            $this->setTab($attributes['tab']);
        }
        
        if (isset($attributes['cache'])) {
            $this->setCache($attributes['cache']);
        }
        
    }
    
    /**
     * Generates the HTML string for the &lt;body&lt; tag
     * 
     * @access  private
     * @return  string
     */
    function _generateBody()
    {
        
        // get line endings
        $lnEnd = $this->_getLineEnd();
        $tab = $this->_getTab();
        
        // If body attributes exist, add them to the body tag.
        // Depreciated because of CSS
        $strAttr = $this->_getAttrString($this->_attributes);
        
        if ($strAttr) {
            $strHtml = "<body $strAttr>" . $lnEnd;
        } else {
            $strHtml = '<body>' . $lnEnd;
        }
        
        // Allow for mixed content in the body array
        // Iterate through the array and process each element
        foreach ($this->_body as $element) {
            if (is_object($element)) {
                if (is_subclass_of($element, "html_common")) {
                    $element->setTab($tab);
                    $element->setTabOffset(1);
                    $element->setLineEnd($lnEnd);
                }
                if (method_exists($element, "toHtml")) {
                    $strHtml .= $element->toHtml() . $lnEnd;
                } elseif (method_exists($element, "toString")) {
                    $strHtml .= $element->toString() . $lnEnd;
                }
            } elseif (is_array($element)) {
                foreach ($element as $level2) {
                    if (is_subclass_of($level2, "html_common")) {
                        $level2->setTabOffset(1);
                        $level2->setTab($tab);
                        $level2->setLineEnd($lnEnd);
                    }
                    if (is_object($level2)) {
                        if (method_exists($level2, "toHtml")) {
                            $strHtml .= $level2->toHtml() . $lnEnd;
                        } elseif (method_exists($level2, "toString")) {
                            $strHtml .= $level2->toString() . $lnEnd;
                        }
                    } else {
                        $strHtml .= $tab . $level2 . $lnEnd;
                    }
                }
            } else {
                $strHtml .= $tab . $element . $lnEnd;
            }
        }
        
        // Close tag
        $strHtml .= '</body>' . $lnEnd;
        
        // Let's roll!
        return $strHtml;
    } // end func _generateHead
    
    /**
     * Generates the HTML string for the &lt;head&lt; tag
     * 
     * @return string
     * @access private
     */
    function _generateHead()
    {
        // close empty tags if XHTML
        if ($this->_doctype['type'] == 'html'){
            $tagEnd = '>';
        } else {
            $tagEnd = ' />';
        }
        
        // get line endings
        $lnEnd = $this->_getLineEnd();
        $tab = $this->_getTab();
        
        $strHtml  = '<head>' . $lnEnd;
        $strHtml .= $tab . '<title>' . $this->getTitle() . '</title>' . $lnEnd;
        
        // Generate META tags
        foreach ($this->_metaTags as $type => $tag) {
            foreach ($tag as $name => $content) {
                if ($type == 'http-equiv') {
                    $strHtml .= $tab . "<meta http-equiv=\"$name\" content=\"$content\"" . $tagEnd . $lnEnd;
                } elseif ($type == 'standard') {
                    $strHtml .= $tab . "<meta name=\"$name\" content=\"$content\"" . $tagEnd . $lnEnd;
                }
            }
        }
        
        // Generate stylesheet links
        foreach ($this->_styleSheets as $strSrc => $strAttr ) {
            $strHtml .= $tab . "<link rel=\"stylesheet\" href=\"$strSrc\" type=\"".$strAttr['mime'].'"';
            if (!is_null($strAttr['media'])){
                $strHtml .= ' media="'.$strAttr['media'].'"';
            }
            $strHtml .= $tagEnd . $lnEnd;
        }
        
        // Generate stylesheet declarations
        foreach ($this->_style as $type => $content) {
            $strHtml .= $tab . '<style type="' . $type . '">' . $lnEnd;
            
            // This is for full XHTML supporte.
            if ($this->_mime == 'text/html' ) {
                $strHtml .= $tab . $tab . '<!--' . $lnEnd;
            } else {
                $strHtml .= $tab . $tab . '<![CDATA[' . $lnEnd;
            }
            
            if (is_object($content)) {
                
                // first let's propagate line endings and tabs for other HTML_Common-based objects
                if (is_subclass_of($content, "html_common")) {
                    $content->setTab($tab);
                    $content->setTabOffset(3);
                    $content->setLineEnd($lnEnd);
                }
                
                // now let's get a string from the object
                if (method_exists($content, "toString")) {
                    $strHtml .= $content->toString() . $lnEnd;
                } else {
                    return PEAR::raiseError('Error: Style content object does not support  method toString().',
                    0,PEAR_ERROR_TRIGGER);
                }
                
            } else {
                $strHtml .= $content . $lnEnd;
            }
            
            // See above note
            
            if ($this->_mime == 'text/html' ) {
                $strHtml .= $tab . $tab . '-->' . $lnEnd;
            } else {
                $strHtml .= $tab . $tab . ']]>' . $lnEnd;
            }
            $strHtml .= $tab . '</style>' . $lnEnd;
        }
        
        // Generate script file links
        foreach ($this->_scripts as $strSrc => $strType) {
            $strHtml .= $tab . "<script type=\"$strType\" src=\"$strSrc\"></script>" . $lnEnd;
        }
        
        // Generate script declarations
        foreach ($this->_script as $type => $content) {
            $strHtml .= $tab . '<script type="' . $type . '">' . $lnEnd;
            
            // This is for full XHTML support.
            if ($this->_mime == 'text/html' ) {
                $strHtml .= $tab . $tab . '<!--' . $lnEnd;
            } else {
                $strHtml .= $tab . $tab . '<![CDATA[' . $lnEnd;
            }
            
            if (is_object($content)) {
                
                // first let's propagate line endings and tabs for other HTML_Common-based objects
                if (is_subclass_of($content, "html_common")) {
                    $content->setTab($tab);
                    $content->setTabOffset(3);
                    $content->setLineEnd($lnEnd);
                }
                
                // now let's get a string from the object
                if (method_exists($content, "toString")) {
                    $strHtml .= $content->toString() . $lnEnd;
                } else {
                    return PEAR::raiseError('Error: Script content object does not support  method toString().',
                    0,PEAR_ERROR_TRIGGER);
                }
                
            } else {
                $strHtml .= $content . $lnEnd;
            }
            
            // See above note
            if ($this->_mime == 'text/html' ) {
                $strHtml .= $tab . $tab . '-->' . $lnEnd;
            } else {
                $strHtml .= $tab . $tab . ']]>' . $lnEnd;
            }
            $strHtml .= $tab . '</script>' . $lnEnd;
        }
        
        // Close tag
        $strHtml .=  '</head>' . $lnEnd;
        
        // Let's roll!
        return $strHtml;
    } // end func _generateHead
    
    /**
     * Returns the doctype declaration
     *
     * @return mixed
     * @access private
     */
    function _getDoctype()
    {
        require('HTML/Page/Doctypes.php');
        
        if (isset($this->_doctype['type'])) {
            $type = $this->_doctype['type'];
        }
        
        if (isset($this->_doctype['version'])) {
            $version = $this->_doctype['version'];
        }
        
        if (isset($this->_doctype['variant'])) {
            $variant = $this->_doctype['variant'];
        }
        
        $strDoctype = '';
        
        if (isset($variant)) {
            if (isset($doctype[$type][$version][$variant][0])) {
                foreach ( $doctype[$type][$version][$variant] as $string) {
                    $strDoctype .= $string.$this->_getLineEnd();
                }
            }
        } elseif (isset($version)) {
            if (isset($doctype[$type][$version][0])) {
                foreach ( $doctype[$type][$version] as $string) {
                    $strDoctype .= $string.$this->_getLineEnd();
                }
            } else {
                if (isset($default[$type][$version][0])) {
                    $this->_doctype = $this->_parseDoctypeString($default[$type][$version][0]);
                    $strDoctype = $this->_getDoctype();
                }
            }
        } elseif (isset($type)) {
            if (isset($default[$type][0])){
                $this->_doctype = $this->_parseDoctypeString($default[$type][0]);
                $strDoctype = $this->_getDoctype();
            }
        } else {
            $this->_doctype = $this->_parseDoctypeString($default['default'][0]);
            $strDoctype = $this->_getDoctype();
        }
        
        if ($strDoctype) {
            return $strDoctype;
        } else {
            return PEAR::raiseError('Error: "'.$this->getDoctypeString().'" is an unsupported or illegal document type.',
                                    0,PEAR_ERROR_TRIGGER);
        }
        
    } // end func _getDoctype
    
    /**
     * Retrieves the document namespace
     *
     * @return mixed
     * @access private
     */
    function _getNamespace()
    {
        require('HTML/Page/Namespaces.php');
        
        if (isset($this->_doctype['type'])) {
            $type = $this->_doctype['type'];
        }
        
        if (isset($this->_doctype['version'])) {
            $version = $this->_doctype['version'];
        }
        
        if (isset($this->_doctype['variant'])) {
            $variant = $this->_doctype['variant'];
        }
        
        $strNamespace = '';
        
        if (isset($variant)){
            if (isset($namespace[$type][$version][$variant][0]) && is_string($namespace[$type][$version][$variant][0])) {
                $strNamespace = $namespace[$type][$version][$variant][0];
            } elseif (isset($namespace[$type][$version][0]) && is_string($namespace[$type][$version][0]) ) {
                $strNamespace = $namespace[$type][$version][0];
            } elseif (isset($namespace[$type][0]) && is_string($namespace[$type][0]) ) {
                $strNamespace = $namespace[$type][0];
            }
        } elseif (isset($version)) {
            if (isset($namespace[$type][$version][0]) && is_string($namespace[$type][$version][0]) ) {
                $strNamespace = $namespace[$type][$version][0];
            } elseif (isset($namespace[$type][0]) && is_string($namespace[$type][0]) ) {
                $strNamespace = $namespace[$type][0];
            }
        } else {
            if (isset($namespace[$type][0]) && is_string($namespace[$type][0]) ) {
                $strNamespace = $namespace[$type][0];
            }
        }
            
        
        if ($strNamespace) {
            return $strNamespace;
        } else {
            return PEAR::raiseError('Error: "'.$this->getDoctypeString().'" does not have a default namespace. Use setNamespace() to define your namespace.',
                                    0,PEAR_ERROR_TRIGGER);
        }
        
    } // end func _getNamespace
    
    /**
     * Parses a doctype declaration like "XHTML 1.0 Strict" to an array
     *
     * @param   string  $string     The string to be parsed
     * @return string
     * @access private
     */
    function _parseDoctypeString($string)
    {
        $split = explode(' ',strtolower($string));
        $elements = count($split);
        
        if (isset($split[2])){
            $array = array('type'=>$split[0],'version'=>$split[1],'variant'=>$split[2]);
        } elseif (isset($split[1])){
            $array = array('type'=>$split[0],'version'=>$split[1]);
        } else {
            $array = array('type'=>$split[0]);
        }
        
        return $array;
    } // end func _parseDoctypeString
    
    /**
     * Sets the content of the &lt;body&gt; tag. If content already exists,
     * the new content is appended.
     * If you wish to overwrite whatever is in the body, use {@link setBody};
     * {@link unsetBody} completely empties the body without inserting new content.
     * It is possible to add objects, strings or an array of strings and/or objects
     * Objects must have a toString method.
     * 
     * @param mixed $content  New &lt;body&gt; tag content (may be passed as a reference)
     * @access public
     */
    function addBodyContent($content)
    {
        $this->_body[] =& $content;
    } // end addBodyContent    
    
    /**
     * Adds a linked script to the page
     * 
     * @param    string  $url        URL to the linked script
     * @param    string  $type       Type of script. Defaults to 'text/javascript'
     * @access   public
     */
    function addScript($url, $type="text/javascript")
    {
        $this->_scripts[$url] = $type;
    } // end func addScript
    
    /**
     * Adds a script to the page.
     * Content can be a string or an object with a toString method.
     * Defaults to text/javascript.
     * 
     * @access   public
     * @param    mixed   $content   Script (may be passed as a reference)
     * @param    string  $type      Scripting mime (defaults to 'text/javascript')
     * @return   void
     */
    function addScriptDeclaration($content, $type = 'text/javascript')
    {
        $this->_script[strtolower($type)] =& $content;
    } // end func addScriptDeclaration
    
    /**
     * Adds a linked stylesheet to the page
     * 
     * @param    string  $url    URL to the linked style sheet
     * @param    string  $type   Mime encoding type
     * @param    string  $media  Media type that this stylesheet applies to
     * @access   public
     * @return   void
     */
    function addStyleSheet($url, $type = 'text/css', $media = null)
    {
        $this->_styleSheets[$url]['mime']  = $type;
        $this->_styleSheets[$url]['media'] = $media;
    } // end func addStyleSheet
    
    /**
     * Adds a stylesheet declaration to the page.
     * Content can be a string or an object with a toString method.
     * Defaults to text/css.
     * 
     * @access   public
     * @param    mixed   $content   Style declarations (may be passed as a reference)
     * @param    string  $type      Type of stylesheet (defaults to 'text/css')
     * @return   void
     */
    function addStyleDeclaration($content, $type = 'text/css')
    {
        $this->_style[strtolower($type)] =& $content;
    } // end func addStyleDeclaration
    
    /**
     * Returns the current API version
     * 
     * @access   public
     * @return   double
     */
    function apiVersion()
    {
        return 2.0;
    } // end func apiVersion
    
    /**
     *  Disables prepending the XML prolog for XHTML documents
     * 
     * @access   public
     * @return  void
     */
    function disableXmlProlog()
    {
        $this->_xmlProlog = false;
    } // end func disableXmlProlog
    
    /**
     *  Enables prepending the XML prolog for XHTML documents (default)
     * 
     * @access   public
     * @return   void
     */
    function enableXmlProlog()
    {
        $this->_xmlProlog = true;
    } // end func enableXmlProlog
    
    /**
     * Returns the document charset encoding.
     * 
     * @access public
     * @return string
     */
    function getCharset()
    {
        return $this->_charset;
    } // end setCache
    
    /**
     * Returns the document type string
     *
     * @access public
     * @return string
     */
    function getDoctypeString()
    {
        $strDoctype = strtoupper($this->_doctype['type']);
        $strDoctype .= ' '.ucfirst(strtolower($this->_doctype['version']));
        if ($this->_doctype['variant']) {
            $strDoctype .= ' ' . ucfirst(strtolower($this->_doctype['variant']));
        }
        return trim($strDoctype);
    } // end func getDoctypeString
    
    /**
     * Returns the document language.
     * 
     * @return string
     * @access public
     */
    function getLang()
    {
        return $this->_language;
    } // end func getLang
    
    /**
     * Return the title of the page.
     * 
     * @return   string
     * @access   public
     */
    function getTitle()
    {
        if (!$this->_title){
            if ($this->_simple) {
                return 'New Page';
            } else {
                return 'New '. $this->getDoctypeString() . ' Compliant Page';
            }
        } else {
            return $this->_title;
        }
    } // end func getTitle
    
    /**
     * Sets the content of the &lt;body&gt; tag. If content exists, it is overwritten.
     * If you wish to use a "safe" version, use {@link addBodyContent}
     * Objects must have a toString method.
     * 
     * @param mixed $content New &lt;body&gt; tag content. May be an object. (may be passed as a reference)
     * @access public
     */
    function setBody($content)
    {
        $this->unsetBody();
        $this->_body[] =& $content;
    } // end setBody
    
    /**
     * Unsets the content of the &lt;body&gt; tag.
     * 
     * @access public
     */
    function unsetBody()
    {
        $this->_body = array();
    } // end unsetBody
        
    /**
     * Defines if the document should be cached by the browser. Defaults to false.
     * 
     * @param string $cache Options are currently 'true' or 'false'. Defaults to 'false'.
     * @access public
     */
    function setCache($cache = 'false')
    {
        if ($cache == 'true'){
            $this->_cache = true;
        } else {
            $this->_cache = false;
        }
    } // end setCache
    
    /**
     * Defines if the document should be cached by the browser. Defaults to false.
     * 
     * @param string $cache Options are currently 'true' or 'false'. Defaults to 'false'.
     * @access  public
     * @return  void
     */
    function setCharset($type = 'utf-8')
    {
        $this->_charset = $type;
    } // end setCache
    
    /**
     * Sets or alters the XHTML !DOCTYPE declaration. Can be set to "strict",
     * "transitional" or "frameset". Defaults to "transitional". This must come
     * _after_ declaring the character encoding with {@link setCharset} or directly
     * when the class is initiated {@link HTML_Page}.
     * 
     * @param string $type   String containing a document type. Defaults to "XHTML 1.0 Transitional"
     * @access  public
     * @return  void
     */
    function setDoctype($type = "XHTML 1.0 Transitional")
    {
        $this->_doctype = $this->_parseDoctypeString($type);
    } // end func setDoctype
    
    /**
     * Sets the global document language declaration. Default is English.
     * 
     * @access public
     * @param string $lang Two-letter language designation.
     */
    function setLang($lang = "en")
    {
        $this->_language = strtolower($lang);
    } // end setLang
    
    /**
     * Sets or alters a meta tag.
     * 
     * @param string  $name     Value of name or http-equiv tag
     * @param string  $content  Value of the content tag
     * @param bool    $http_equiv     META type "http-equiv" defaults to NULL
     * @return void
     * @access public
     */
    function setMetaData($name, $content, $http_equiv = false)
    {
        if ($http_equiv == true) {
            $this->_metaTags['http-equiv'][$name] = $content;
        } else {
            $this->_metaTags['standard'][$name] = $content;
        }
    } // end func setMetaData
    
    /**
     * Sets an http-equiv Content-Type meta tag
     * 
     * @access   public
     * @return   void
     */
    function setMetaContentType()
    {
        $this->setMetaData('Content-Type', $this->_mime . '; charset=' . $this->_charset , true );
    } // end func setMetaContentType
    
    /**
     * Easily sets or alters a refresh meta tag. 
     * If no $url is passed, "self" is presupposed, and the appropriate URL
     * will be automatically generated.
     * 
     * @param string  $time    Time till refresh (in seconds)
     * @param string  $url     Absolute URL or "self"
     * @param bool    $https   If $url = self, this allows for the https protocol defaults to NULL
     * @return void
     * @access public
     */
    function setMetaRefresh($time, $url = 'self', $https = false)
    {
        if ($url == 'self') {
            if ($https) { 
                $protocol = 'https://';
            } else {
                $protocol = 'http://';
            }
            $url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        }
        $this->setMetaData("Refresh", "$time; url=$url", true);
    } // end func setMetaRefresh
    
    /**
     * Sets the document MIME encoding that is sent to the browser.
     * 
     * @param    string    $type
     * @access   public
     * @return   void
     */
    function setMimeEncoding($type = 'text/html')
    {
        $this->_mime = strtolower($type);
    } // end func setMimeEncoding
    
    /**
     * Sets the document namespace
     * 
     * @param    string    $namespace  Optional. W3C namespaces are used by default.
     * @access   public
     * @return   void
     */
    function setNamespace($namespace = '')
    {
        if (isset($namespace)){
            $this->_namespace = $namespace;
        } else {
            $this->_namespace = $this->_getNamespace();
        }
    } // end func setTitle
    
    /**
     * Sets the title of the page
     * 
     * @param    string    $title
     * @access   public
     * @return   void
     */
    function setTitle($title)
    {
        $this->_title = $title;
    } // end func setTitle
    
    /**
     * Generates and returns the complete page as a string.
     * 
     * @return string
     * @access public
     */
    function toHTML()
    {
        
        // get line endings
        $lnEnd = $this->_getLineEnd();
        
        // get the doctype declaration
        $strDoctype = $this->_getDoctype();
        
        // This determines how the doctype is declared
        if ($this->_simple) {
            
            $strHtml = '<html>' . $lnEnd;
            
        } elseif ($this->_doctype['type'] == 'xhtml') {
            
            // get the namespace if not already set
            if (!$this->_namespace){
                $this->_namespace = $this->_getNamespace();
            }
            
            $strHtml = $strDoctype . $lnEnd;
            $strHtml .= '<html xmlns="' . $this->_namespace . '" xml:lang="' . $this->_language . '">' . $lnEnd;

            // check whether the XML prolog should be prepended
            if ($this->_xmlProlog){
                $strHtml  = '<?xml version="1.0" encoding="' . $this->_charset . '"?>' . $lnEnd . $strHtml;
            }
            
        } else {
            
            $strHtml  = $strDoctype . $lnEnd;
            $strHtml .= '<html>' . $lnEnd;
            
        }

        $strHtml .= $this->_generateHead();
        $strHtml .= $this->_generateBody();
        $strHtml .= '</html>';
        return $strHtml;
    } // end func toHtml
    
    /**
     * Generates the document and outputs it to a file.
     *
     * @return  void
     * @since   2.0
     * @access  public
     */
    function toFile($filename)
    {
        if (function_exists('file_put_content')){
            file_put_content($filename, $this->toHtml());
        } else {
            $file = fopen($filename,'wb');
            fwrite($file, $this->toHtml());
            fclose($file);
        }
        if (!file_exists($filename)){
            PEAR::raiseError("HTML_Page::toFile() error: Failed to write to $filename",0,PEAR_ERROR_TRIGGER);
        }
        
    } // end func toFile
    
    /**
     * Outputs the HTML content to the screen.
     * 
     * @access    public
     */
    function display()
    {
        if(! $this->_cache) {
            header("Expires: Tue, 1 Jan 1980 12:00:00 GMT");
            header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
            header("Cache-Control: no-cache");
            header("Pragma: no-cache");
        }
        
        // set character encoding
        header('Content-Type: ' . $this->_mime .  '; charset=' . $this->_charset);
        
        $strHtml = $this->toHTML();
        print $strHtml;
    } // end func display
    
}
?>
