<?php

namespace App\Http\Controllers;

use ZipArchive;
use App\Models\File;
use App\Models\Group;
use App\Models\Message;
use Illuminate\Http\Request;

use function Laravel\Prompts\form;
use Illuminate\Support\Facades\Storage;
use League\CommonMark\Extension\CommonMark\Node\Inline\Code;
use Symfony\Component\HttpFoundation\File\MimeType\MimeTypeGuesser;

class FileController extends Controller
{

    public function index(Group $group)
    {
        if (auth()->user()->id == $group->leader_id) {
            $taskscount = $group->tasks->where('status', 'submitted')->count();
        } else {
            $taskscount = auth()->user()->tasks->where('group_id', $group->id)->where('status', 'assigned')->count();
        }
        $userid = auth()->user()->id;
        $mescount = [];
        foreach ($group->members as $member) {
            $mescount[$member->id] = Message::where('sender_id', $member->id)
                ->where('receiver_id', $userid)->where('seen', false)->count();
        }
        // dd($group->documents);
        return view('file.index', [
            'groups' => auth()->user()->memberships,
            'mainGroup' => $group,
            'members' => $group->members,
            'invitaion_count' => count($group->invitedBy),
            'files' => $group->files,
            'taskcount' => $taskscount,
            'mescount' => $mescount
        ]);
    }

    public function store(Request $request, Group $group)
    {
        $formFields = $request->validate([
            'file' => 'required'
        ]);

        // dd($request);
        $formfile = $request->file('file');
        $originalFilename = $formfile->getClientOriginalName();
        // dd($originalFilename);

        $exists = File::where('title', $originalFilename)->exists();
        // dd($exists);
        // if the file exist we will add a new version to the file
        if ($exists) {
            $file = File::where('title', $originalFilename)->first();

            if (!$formfile->getClientOriginalExtension() == "") {
                $fileName = time() . '.' . $request->file('file')->getClientOriginalExtension();
            } else {
                $fileName = time();
            }
            $formversion['path'] = $request->file('file')->storeAs('files', $fileName, 'public');

            // $formversion['path'] = $request->file('file')->store('files', 'public');
            $formversion['file_id'] = $file->id;
            $formversion['version'] = $file->currentVersion()->version + 0.1;
            $formversion['size'] = $formfile->getSize() / 1000;
            $version = $file->versions()->create($formversion);

            return redirect()->back()->with('message', 'File updated successfully');
        }
        // if the file does not exist we will create a new file
        else {
            // we creat the file first
            $form['title'] = $originalFilename;
            $form['type'] = $formfile->getClientOriginalExtension();
            $form['group_id'] = $group->id;
            $file = $group->files()->create($form);

            // we creat it first version by default it's 1.0
            if (!$formfile->getClientOriginalExtension() == "") {
                $fileName = time() . '.' . $request->file('file')->getClientOriginalExtension();
            } else {
                $fileName = time();
            }
            // dd($formfile->getClientOriginalExtension());
            $formversion['path'] = $request->file('file')->storeAs('files', $fileName, 'public');

            // $formversion['path'] = $request->file('file')->store('files', 'public');
            $formversion['file_id'] = $file->id;
            $formversion['version'] = 1;
            $formversion['size'] = $formfile->getSize() / 1000;
            $version = $file->versions()->create($formversion);

            return redirect()->back()->with('message', 'File uploaded successfully');
        }
    }

    public function show(Group $group, File $file)
    {
        // dd($file);
        $array = ["abap", "asc", "ash", "ampl", "mod", "g4", "apib", "apl", "dyalog", "asp", "asax", "ascx", "ashx", "asmx", "aspx", "axd", "dats", "hats", "sats", "as", "adb", "ada", "ads", "agda", "als", "apacheconf", "vhost", "cls", "applescript", "scpt", "arc", "ino", "asciidoc", "adoc", "asc", "aj", "asm", "a51", "inc", "nasm", "aug", "ahk", "ahkl", "au3", "awk", "auk", "gawk", "mawk", "nawk", "bat", "cmd", "befunge", "bison", "bb", "bb", "decls", "bmx", "bsv", "boo", "b", "bf", "brs", "bro", "c", "cats", "h", "idc", "w", "cs", "cake", "cshtml", "csx", "cpp", "c++", "cc", "cp", "cxx", "h", "h++", "hh", "hpp", "hxx", "inc", "inl", "ipp", "tcc", "tpp", "c-objdump", "chs", "clp", "cmake", "cmake", "in", "cob", "cbl", "ccp", "cobol", "cpy", "css", "csv", "capnp", "mss", "ceylon", "chpl", "ch", "ck", "cirru", "clw", "icl", "dcl", "click", "clj", "boot", "cl2", "cljc", "cljs", "cljs", "hl", "cljscm", "cljx", "hic", "coffee", "_coffee", "cake", "cjsx", "cson", "iced", "cfm", "cfml", "cfc", "lisp", "asd", "cl", "l", "lsp", "ny", "podsl", "sexp", "cp", "cps", "cl", "coq", "v", "cppobjdump", "c++-objdump", "c++objdump", "cpp-objdump", "cxx-objdump", "creole", "cr", "feature", "cu", "cuh", "cy", "pyx", "pxd", "pxi", "d", "di", "d-objdump", "com", "dm", "zone", "arpa", "d", "darcspatch", "dpatch", "dart", "diff", "patch", "dockerfile", "djs", "dylan", "dyl", "intr", "lid", "E", "ecl", "eclxml", "ecl", "sch", "brd", "epj", "e", "ex", "exs", "elm", "el", "emacs", "emacs", "desktop", "em", "emberscript", "erl", "es", "escript", "hrl", "xrl", "yrl", "fs", "fsi", "fsx", "fx", "flux", "f90", "f", "f03", "f08", "f77", "f95", "for", "fpp", "factor", "fy", "fancypack", "fan", "fs", "for", "eam", "fs", "fth", "4th", "f", "for", "forth", "fr", "frt", "fs", "ftl", "fr", "g", "gco", "gcode", "gms", "g", "gap", "gd", "gi", "tst", "s", "ms", "gd", "glsl", "fp", "frag", "frg", "fs", "fsh", "fshader", "geo", "geom", "glslv", "gshader", "shader", "vert", "vrx", "vsh", "vshader", "gml", "kid", "ebuild", "eclass", "po", "pot", "glf", "gp", "gnu", "gnuplot", "plot", "plt", "go", "golo", "gs", "gst", "gsx", "vark", "grace", "gradle", "gf", "gml", "graphql", "dot", "gv", "man", "1", "1in", "1m", "1x", "2", "3", "3in", "3m", "3qt", "3x", "4", "5", "6", "7", "8", "9", "l", "me", "ms", "n", "rno", "roff", "groovy", "grt", "gtpl", "gvy", "gsp", "hcl", "tf", "hlsl", "fx", "fxh", "hlsli", "html", "htm", "html", "hl", "inc", "st", "xht", "xhtml", "mustache", "jinja", "eex", "erb", "erb", "deface", "phtml", "http", "hh", "php", "haml", "haml", "deface", "handlebars", "hbs", "hb", "hs", "hsc", "hx", "hxsl", "hy", "bf", "pro", "dlm", "ipf", "ini", "cfg", "prefs", "pro", "properties", "irclog", "weechatlog", "idr", "lidr", "ni", "i7x", "iss", "io", "ik", "thy", "ijs", "flex", "jflex", "json", "geojson", "lock", "topojson", "json5", "jsonld", "jq", "jsx", "jade", "j", "java", "jsp", "js", "_js", "bones", "es", "es6", "frag", "gs", "jake", "jsb", "jscad", "jsfl", "jsm", "jss", "njs", "pac", "sjs", "ssjs", "sublime-build", "sublime-commands", "sublime-completions", "sublime-keymap", "sublime-macro", "sublime-menu", "sublime-mousemap", "sublime-project", "sublime-settings", "sublime-theme", "sublime-workspace", "sublime_metrics", "sublime_session", "xsjs", "xsjslib", "jl", "ipynb", "krl", "sch", "brd", "kicad_pcb", "kit", "kt", "ktm", "kts", "lfe", "ll", "lol", "lsl", "lslp", "lvproj", "lasso", "las", "lasso8", "lasso9", "ldml", "latte", "lean", "hlean", "less", "l", "lex", "ly", "ily", "b", "m", "ld", "lds", "mod", "liquid", "lagda", "litcoffee", "lhs", "ls", "_ls", "xm", "x", "xi", "lgt", "logtalk", "lookml", "ls", "lua", "fcgi", "nse", "pd_lua", "rbxs", "wlua", "mumps", "m", "m4", "m4", "ms", "mcr", "mtml", "muf", "m", "mak", "d", "mk", "mkfile", "mako", "mao", "md", "markdown", "mkd", "mkdn", "mkdown", "ron", "mask", "mathematica", "cdf", "m", "ma", "mt", "nb", "nbp", "wl", "wlt", "matlab", "m", "maxpat", "maxhelp", "maxproj", "mxt", "pat", "mediawiki", "wiki", "m", "moo", "metal", "minid", "druby", "duby", "mir", "mirah", "mo", "mod", "mms", "mmk", "monkey", "moo", "moon", "myt", "ncl", "nl", "nsi", "nsh", "n", "axs", "axi", "axs", "erb", "axi", "erb", "nlogo", "nl", "lisp", "lsp", "nginxconf", "vhost", "nim", "nimrod", "ninja", "nit", "nix", "nu", "numpy", "numpyw", "numsc", "ml", "eliom", "eliomi", "ml4", "mli", "mll", "mly", "objdump", "m", "h", "mm", "j", "sj", "omgrofl", "opa", "opal", "cl", "opencl", "p", "cls", "scad", "org", "ox", "oxh", "oxo", "oxygene", "oz", "pwn", "inc", "php", "aw", "ctp", "fcgi", "inc", "php3", "php4", "php5", "phps", "phpt", "pls", "pck", "pkb", "pks", "plb", "plsql", "sql", "sql", "pov", "inc", "pan", "psc", "parrot", "pasm", "pir", "pas", "dfm", "dpr", "inc", "lpr", "pp", "pl", "al", "cgi", "fcgi", "perl", "ph", "plx", "pm", "pod", "psgi", "t", "6pl", "6pm", "nqp", "p6", "p6l", "p6m", "pl", "pl6", "pm", "pm6", "t", "pkl", "l", "pig", "pike", "pmod", "pod", "pogo", "pony", "ps", "eps", "ps1", "psd1", "psm1", "pde", "pl", "pro", "prolog", "yap", "spin", "proto", "asc", "pub", "pp", "pd", "pb", "pbi", "purs", "py", "bzl", "cgi", "fcgi", "gyp", "lmi", "pyde", "pyp", "pyt", "pyw", "rpy", "tac", "wsgi", "xpy", "pytb", "qml", "qbs", "pro", "pri", "r", "rd", "rsx", "raml", "rdoc", "rbbas", "rbfrm", "rbmnu", "rbres", "rbtbar", "rbuistate", "rhtml", "rmd", "rkt", "rktd", "rktl", "scrbl", "rl", "raw", "reb", "r", "r2", "r3", "rebol", "red", "reds", "cw", "rpy", "rs", "rsh", "robot", "rg", "rb", "builder", "fcgi", "gemspec", "god", "irbrc", "jbuilder", "mspec", "pluginspec", "podspec", "rabl", "rake", "rbuild", "rbw", "rbx", "ru", "ruby", "thor", "watchr", "rs", "rs", "in", "sas", "scss", "smt2", "smt", "sparql", "rq", "sqf", "hqf", "sql", "cql", "ddl", "inc", "prc", "tab", "udf", "viw", "sql", "db2", "ston", "svg", "sage", "sagews", "sls", "sass", "scala", "sbt", "sc", "scaml", "scm", "sld", "sls", "sps", "ss", "sci", "sce", "tst", "self", "sh", "bash", "bats", "cgi", "command", "fcgi", "ksh", "sh", "in", "tmux", "tool", "zsh", "sh-session", "shen", "sl", "slim", "smali", "st", "cs", "tpl", "sp", "inc", "sma", "nut", "stan", "ML", "fun", "sig", "sml", "do", "ado", "doh", "ihlp", "mata", "matah", "sthlp", "styl", "sc", "scd", "swift", "sv", "svh", "vh", "toml", "txl", "tcl", "adp", "tm", "tcsh", "csh", "tex", "aux", "bbx", "bib", "cbx", "cls", "dtx", "ins", "lbx", "ltx", "mkii", "mkiv", "mkvi", "sty", "toc", "tea", "t", "txt", "fr", "nb", "ncl", "no", "textile", "thrift", "t", "tu", "ttl", "twig", "ts", "tsx", "upc", "anim", "asset", "mat", "meta", "prefab", "unity", "uno", "uc", "ur", "urs", "vcl", "vhdl", "vhd", "vhf", "vhi", "vho", "vhs", "vht", "vhw", "vala", "vapi", "v", "veo", "vim", "vb", "bas", "cls", "frm", "frx", "vba", "vbhtml", "vbs", "volt", "vue", "owl", "webidl", "x10", "xc", "xml", "ant", "axml", "ccxml", "clixml", "cproject", "csl", "csproj", "ct", "dita", "ditamap", "ditaval", "dll", "config", "dotsettings", "filters", "fsproj", "fxml", "glade", "gml", "grxml", "iml", "ivy", "jelly", "jsproj", "kml", "launch", "mdpolicy", "mm", "mod", "mxml", "nproj", "nuspec", "odd", "osm", "plist", "pluginspec", "props", "ps1xml", "psc1", "pt", "rdf", "rss", "scxml", "srdf", "storyboard", "stTheme", "sublime-snippet", "targets", "tmCommand", "tml", "tmLanguage", "tmPreferences", "tmSnippet", "tmTheme", "ts", "tsx", "ui", "urdf", "ux", "vbproj", "vcxproj", "vssettings", "vxml", "wsdl", "wsf", "wxi", "wxl", "wxs", "x3d", "xacro", "xaml", "xib", "xlf", "xliff", "xmi", "xml", "dist", "xproj", "xsd", "xul", "zcml", "xsp-config", "xsp", "metadata", "xpl", "xproc", "xquery", "xq", "xql", "xqm", "xqy", "xs", "xslt", "xsl", "xojo_code", "xojo_menu", "xojo_report", "xojo_script", "xojo_toolbar", "xojo_window", "xtend", "yml", "reek", "rviz", "sublime-syntax", "syntax", "yaml", "yaml-tmlanguage", "yang", "y", "yacc", "yy", "zep", "zimpl", "zmpl", "zpl", "desktop", "desktop", "in", "ec", "eh", "edn", "fish", "mu", "nc", "ooc", "rst", "rest", "rest", "txt", "rst", "txt", "wisp", "prg", "ch", "gitignore", "prw"];
        $lang = $file->type;
        // dd($lang);
        if (in_array($lang, $array)) {
            $path = storage_path('app/public/' . $file->currentVersion()->path);
            $codefile = fopen($path, 'r'); // Open the file for reading
            $code = fread($codefile, filesize($path)); // Read the entire file content
            // dd($code);
            fclose($codefile); // Close the file handle
        } else {
            $lang = 'text';
            $code = 'not a readable file                                                                ';
        }
        if (auth()->user()->id == $group->leader_id) {
            $taskscount = $group->tasks->where('status', 'submitted')->count();
        } else {
            $taskscount = auth()->user()->tasks->where('group_id', $group->id)->where('status', 'assigned')->count();
        }
        $userid = auth()->user()->id;
        $mescount = [];
        foreach ($group->members as $member) {
            $mescount[$member->id] = Message::where('sender_id', $member->id)
                ->where('receiver_id', $userid)->where('seen', false)->count();
        }
        return view('file.show', [
            'groups' => auth()->user()->memberships,
            'mainGroup' => $group,
            'members' => $group->members,
            'invitaion_count' => count($group->invitedBy),
            'code' => $code,
            'lang' => $lang,
            'name' => $file->title,
            'version' => $file->currentVersion()->version,
            'taskcount' => $taskscount, 'mescount' => $mescount
        ]);
    }

    public function show_version(Request $request, Group $group, File $file)
    {
        // dd($id = $request->route('version'));
        $id = $request->route('version');

        $array = ["abap", "asc", "ash", "ampl", "mod", "g4", "apib", "apl", "dyalog", "asp", "asax", "ascx", "ashx", "asmx", "aspx", "axd", "dats", "hats", "sats", "as", "adb", "ada", "ads", "agda", "als", "apacheconf", "vhost", "cls", "applescript", "scpt", "arc", "ino", "asciidoc", "adoc", "asc", "aj", "asm", "a51", "inc", "nasm", "aug", "ahk", "ahkl", "au3", "awk", "auk", "gawk", "mawk", "nawk", "bat", "cmd", "befunge", "bison", "bb", "bb", "decls", "bmx", "bsv", "boo", "b", "bf", "brs", "bro", "c", "cats", "h", "idc", "w", "cs", "cake", "cshtml", "csx", "cpp", "c++", "cc", "cp", "cxx", "h", "h++", "hh", "hpp", "hxx", "inc", "inl", "ipp", "tcc", "tpp", "c-objdump", "chs", "clp", "cmake", "cmake", "in", "cob", "cbl", "ccp", "cobol", "cpy", "css", "csv", "capnp", "mss", "ceylon", "chpl", "ch", "ck", "cirru", "clw", "icl", "dcl", "click", "clj", "boot", "cl2", "cljc", "cljs", "cljs", "hl", "cljscm", "cljx", "hic", "coffee", "_coffee", "cake", "cjsx", "cson", "iced", "cfm", "cfml", "cfc", "lisp", "asd", "cl", "l", "lsp", "ny", "podsl", "sexp", "cp", "cps", "cl", "coq", "v", "cppobjdump", "c++-objdump", "c++objdump", "cpp-objdump", "cxx-objdump", "creole", "cr", "feature", "cu", "cuh", "cy", "pyx", "pxd", "pxi", "d", "di", "d-objdump", "com", "dm", "zone", "arpa", "d", "darcspatch", "dpatch", "dart", "diff", "patch", "dockerfile", "djs", "dylan", "dyl", "intr", "lid", "E", "ecl", "eclxml", "ecl", "sch", "brd", "epj", "e", "ex", "exs", "elm", "el", "emacs", "emacs", "desktop", "em", "emberscript", "erl", "es", "escript", "hrl", "xrl", "yrl", "fs", "fsi", "fsx", "fx", "flux", "f90", "f", "f03", "f08", "f77", "f95", "for", "fpp", "factor", "fy", "fancypack", "fan", "fs", "for", "eam", "fs", "fth", "4th", "f", "for", "forth", "fr", "frt", "fs", "ftl", "fr", "g", "gco", "gcode", "gms", "g", "gap", "gd", "gi", "tst", "s", "ms", "gd", "glsl", "fp", "frag", "frg", "fs", "fsh", "fshader", "geo", "geom", "glslv", "gshader", "shader", "vert", "vrx", "vsh", "vshader", "gml", "kid", "ebuild", "eclass", "po", "pot", "glf", "gp", "gnu", "gnuplot", "plot", "plt", "go", "golo", "gs", "gst", "gsx", "vark", "grace", "gradle", "gf", "gml", "graphql", "dot", "gv", "man", "1", "1in", "1m", "1x", "2", "3", "3in", "3m", "3qt", "3x", "4", "5", "6", "7", "8", "9", "l", "me", "ms", "n", "rno", "roff", "groovy", "grt", "gtpl", "gvy", "gsp", "hcl", "tf", "hlsl", "fx", "fxh", "hlsli", "html", "htm", "html", "hl", "inc", "st", "xht", "xhtml", "mustache", "jinja", "eex", "erb", "erb", "deface", "phtml", "http", "hh", "php", "haml", "haml", "deface", "handlebars", "hbs", "hb", "hs", "hsc", "hx", "hxsl", "hy", "bf", "pro", "dlm", "ipf", "ini", "cfg", "prefs", "pro", "properties", "irclog", "weechatlog", "idr", "lidr", "ni", "i7x", "iss", "io", "ik", "thy", "ijs", "flex", "jflex", "json", "geojson", "lock", "topojson", "json5", "jsonld", "jq", "jsx", "jade", "j", "java", "jsp", "js", "_js", "bones", "es", "es6", "frag", "gs", "jake", "jsb", "jscad", "jsfl", "jsm", "jss", "njs", "pac", "sjs", "ssjs", "sublime-build", "sublime-commands", "sublime-completions", "sublime-keymap", "sublime-macro", "sublime-menu", "sublime-mousemap", "sublime-project", "sublime-settings", "sublime-theme", "sublime-workspace", "sublime_metrics", "sublime_session", "xsjs", "xsjslib", "jl", "ipynb", "krl", "sch", "brd", "kicad_pcb", "kit", "kt", "ktm", "kts", "lfe", "ll", "lol", "lsl", "lslp", "lvproj", "lasso", "las", "lasso8", "lasso9", "ldml", "latte", "lean", "hlean", "less", "l", "lex", "ly", "ily", "b", "m", "ld", "lds", "mod", "liquid", "lagda", "litcoffee", "lhs", "ls", "_ls", "xm", "x", "xi", "lgt", "logtalk", "lookml", "ls", "lua", "fcgi", "nse", "pd_lua", "rbxs", "wlua", "mumps", "m", "m4", "m4", "ms", "mcr", "mtml", "muf", "m", "mak", "d", "mk", "mkfile", "mako", "mao", "md", "markdown", "mkd", "mkdn", "mkdown", "ron", "mask", "mathematica", "cdf", "m", "ma", "mt", "nb", "nbp", "wl", "wlt", "matlab", "m", "maxpat", "maxhelp", "maxproj", "mxt", "pat", "mediawiki", "wiki", "m", "moo", "metal", "minid", "druby", "duby", "mir", "mirah", "mo", "mod", "mms", "mmk", "monkey", "moo", "moon", "myt", "ncl", "nl", "nsi", "nsh", "n", "axs", "axi", "axs", "erb", "axi", "erb", "nlogo", "nl", "lisp", "lsp", "nginxconf", "vhost", "nim", "nimrod", "ninja", "nit", "nix", "nu", "numpy", "numpyw", "numsc", "ml", "eliom", "eliomi", "ml4", "mli", "mll", "mly", "objdump", "m", "h", "mm", "j", "sj", "omgrofl", "opa", "opal", "cl", "opencl", "p", "cls", "scad", "org", "ox", "oxh", "oxo", "oxygene", "oz", "pwn", "inc", "php", "aw", "ctp", "fcgi", "inc", "php3", "php4", "php5", "phps", "phpt", "pls", "pck", "pkb", "pks", "plb", "plsql", "sql", "sql", "pov", "inc", "pan", "psc", "parrot", "pasm", "pir", "pas", "dfm", "dpr", "inc", "lpr", "pp", "pl", "al", "cgi", "fcgi", "perl", "ph", "plx", "pm", "pod", "psgi", "t", "6pl", "6pm", "nqp", "p6", "p6l", "p6m", "pl", "pl6", "pm", "pm6", "t", "pkl", "l", "pig", "pike", "pmod", "pod", "pogo", "pony", "ps", "eps", "ps1", "psd1", "psm1", "pde", "pl", "pro", "prolog", "yap", "spin", "proto", "asc", "pub", "pp", "pd", "pb", "pbi", "purs", "py", "bzl", "cgi", "fcgi", "gyp", "lmi", "pyde", "pyp", "pyt", "pyw", "rpy", "tac", "wsgi", "xpy", "pytb", "qml", "qbs", "pro", "pri", "r", "rd", "rsx", "raml", "rdoc", "rbbas", "rbfrm", "rbmnu", "rbres", "rbtbar", "rbuistate", "rhtml", "rmd", "rkt", "rktd", "rktl", "scrbl", "rl", "raw", "reb", "r", "r2", "r3", "rebol", "red", "reds", "cw", "rpy", "rs", "rsh", "robot", "rg", "rb", "builder", "fcgi", "gemspec", "god", "irbrc", "jbuilder", "mspec", "pluginspec", "podspec", "rabl", "rake", "rbuild", "rbw", "rbx", "ru", "ruby", "thor", "watchr", "rs", "rs", "in", "sas", "scss", "smt2", "smt", "sparql", "rq", "sqf", "hqf", "sql", "cql", "ddl", "inc", "prc", "tab", "udf", "viw", "sql", "db2", "ston", "svg", "sage", "sagews", "sls", "sass", "scala", "sbt", "sc", "scaml", "scm", "sld", "sls", "sps", "ss", "sci", "sce", "tst", "self", "sh", "bash", "bats", "cgi", "command", "fcgi", "ksh", "sh", "in", "tmux", "tool", "zsh", "sh-session", "shen", "sl", "slim", "smali", "st", "cs", "tpl", "sp", "inc", "sma", "nut", "stan", "ML", "fun", "sig", "sml", "do", "ado", "doh", "ihlp", "mata", "matah", "sthlp", "styl", "sc", "scd", "swift", "sv", "svh", "vh", "toml", "txl", "tcl", "adp", "tm", "tcsh", "csh", "tex", "aux", "bbx", "bib", "cbx", "cls", "dtx", "ins", "lbx", "ltx", "mkii", "mkiv", "mkvi", "sty", "toc", "tea", "t", "txt", "fr", "nb", "ncl", "no", "textile", "thrift", "t", "tu", "ttl", "twig", "ts", "tsx", "upc", "anim", "asset", "mat", "meta", "prefab", "unity", "uno", "uc", "ur", "urs", "vcl", "vhdl", "vhd", "vhf", "vhi", "vho", "vhs", "vht", "vhw", "vala", "vapi", "v", "veo", "vim", "vb", "bas", "cls", "frm", "frx", "vba", "vbhtml", "vbs", "volt", "vue", "owl", "webidl", "x10", "xc", "xml", "ant", "axml", "ccxml", "clixml", "cproject", "csl", "csproj", "ct", "dita", "ditamap", "ditaval", "dll", "config", "dotsettings", "filters", "fsproj", "fxml", "glade", "gml", "grxml", "iml", "ivy", "jelly", "jsproj", "kml", "launch", "mdpolicy", "mm", "mod", "mxml", "nproj", "nuspec", "odd", "osm", "plist", "pluginspec", "props", "ps1xml", "psc1", "pt", "rdf", "rss", "scxml", "srdf", "storyboard", "stTheme", "sublime-snippet", "targets", "tmCommand", "tml", "tmLanguage", "tmPreferences", "tmSnippet", "tmTheme", "ts", "tsx", "ui", "urdf", "ux", "vbproj", "vcxproj", "vssettings", "vxml", "wsdl", "wsf", "wxi", "wxl", "wxs", "x3d", "xacro", "xaml", "xib", "xlf", "xliff", "xmi", "xml", "dist", "xproj", "xsd", "xul", "zcml", "xsp-config", "xsp", "metadata", "xpl", "xproc", "xquery", "xq", "xql", "xqm", "xqy", "xs", "xslt", "xsl", "xojo_code", "xojo_menu", "xojo_report", "xojo_script", "xojo_toolbar", "xojo_window", "xtend", "yml", "reek", "rviz", "sublime-syntax", "syntax", "yaml", "yaml-tmlanguage", "yang", "y", "yacc", "yy", "zep", "zimpl", "zmpl", "zpl", "desktop", "desktop", "in", "ec", "eh", "edn", "fish", "mu", "nc", "ooc", "rst", "rest", "rest", "txt", "rst", "txt", "wisp", "prg", "ch", "prw"];
        $lang = $file->type;

        // dd($file->versions->find($id));
        $version = $file->versions->find($id);

        if (in_array($lang, $array)) {
            $path = storage_path('app/public/' . $version->path);
            $codefile = fopen($path, 'r'); // Open the file for reading
            $code = fread($codefile, filesize($path)); // Read the entire file content
            // dd($code);
            fclose($codefile); // Close the file handle
        } else {
            $lang = 'text';
            $code = 'not a readable file                                                                ';
        }
        if (auth()->user()->id == $group->leader_id) {
            $taskscount = $group->tasks->where('status', 'submitted')->count();
        } else {
            $taskscount = auth()->user()->tasks->where('group_id', $group->id)->where('status', 'assigned')->count();
        }
        $userid = auth()->user()->id;
        $mescount = [];
        foreach ($group->members as $member) {
            $mescount[$member->id] = Message::where('sender_id', $member->id)
                ->where('receiver_id', $userid)->where('seen', false)->count();
        }
        return view('file.show', [
            'groups' => auth()->user()->memberships,
            'mainGroup' => $group,
            'members' => $group->members,
            'invitaion_count' => count($group->invitedBy),
            'code' => $code,
            'lang' => $lang,
            'name' => $file->title,
            'version' => $version->version,
            'taskcount' => $taskscount, 'mescount' => $mescount
        ]);
    }
    public function delete(Group $group, File $file)
    {
        // dd($file);
        // Storage::disk('public')->delete();
        // dd($file->versions);
        foreach ($file->versions as $version) {
            Storage::disk('public')->delete($version->path);
        }
        $file->delete();
        return redirect()->back()->with('message', 'File deleted successfully');
    }

    public function zip(Group $group)
    {
        $zip = new ZipArchive();
        $files = $group->files;
        if ($zip->open($group->title . '.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE)) {
            $i = 0;
            foreach ($files as $file) {
                // Get the filename without the path
                $name = $file->title;
                $zip->addFile(storage_path('app/public/' . $file->currentVersion()->path), $name);
            }
            $zip->close();
        }

        // Serve the ZIP file for download
        return response()->download($group->title . '.zip')->deleteFileAfterSend(true);
    }
    //
}
