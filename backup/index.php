<%-- #RevizeProperties USE REVIZE MENU (DOCUMENT PROPERTIES) TO EDIT DATA BELOW:
status=edit
options=
server=localhost
projectName=gadsdencounty
label=index
location=index.php
version=54
docType=template
subType=unique
moduleName=
fieldName=
channels=revize|
description=
--%><%-- #BeginRZ-PageHeader --%><%@
page language="java" %><%@
include file="/util/setup_template_header.jsp"
%><%-- #EndRZ-PageHeader --%>
<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!--Metadata Area Starts-->
   <%@ include file="/gadsdencounty/_includes_/freeform_metadata.jsp"%>
   <meta name="robots" content="index, follow">
  <!--Metadata Area Ends-->

	<%@ include file="/util/setup_template_before_endhead.jsp" %>
  <link rel="stylesheet" href="_assets_/plugins/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="_assets_/fonts/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="_assets_/plugins/owl.carousel/owl-carousel/owl.carousel.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
	<link rel="stylesheet" href="_assets_/css/layout.css">

	<link rel="shortcut icon" href="_assets_/images/favicon.ico">
	<link rel="apple-touch-icon" href="_assets_/images/touch-icon-iphone.png">
	<link rel="apple-touch-icon" sizes="72x72" href="_assets_/images/touch-icon-ipad.png">
	<link rel="apple-touch-icon" sizes="114x114" href="_assets_/images/touch-icon-iphone4.png">
	<link rel="apple-touch-icon" sizes="144x144" href="_assets_/images/touch-icon-ipad2.png">

	<!--[if !IE]><!-->
	<link rel="stylesheet" href="_assets_/plugins/add-to-homescreen/style/addtohomescreen.css">
	<script src="_assets_/plugins/add-to-homescreen/src/addtohomescreen.min.js"></script>
	<script>addToHomescreen();</script>
	<!--<![endif]-->

	<!-- Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>
<body id="homepage">

<%@ include file="/util/setup_template_javascript.jsp" %>
<%@ include file="/gadsdencounty/_includes_/global_menu_variables.jsp" %>
<%@ include file="/gadsdencounty/_includes_/helper_methods.jsp" %>
<header class="clearfix">
	<?php smartInclude("top_bar.php");?>

	<div class="clearfix">
		<nav class="container">
  		<?php smartInclude("toggles.php");?>
							<!-- start plugin: menus.topnav-include -->
<%
			// define linkplacement & revize_menu_filter used by webspace_menu-editlist & rz:list
			revize_menu_linkplacement = "topnav";
			revize_menu_filter = "linkplacement=" + revize_menu_linkplacement + " and linkparentid=0";
			%>
			<div class="float_button_anchor">
        <jsp:include page="/plugins/menus/menus.topnav_include.jsp">
          <jsp:param name="technology" value="php" />
          <jsp:param name="includepath" value="<%=rz.includefile("_includes_")%>" />
          <jsp:param name="debug" value="false" />
        </jsp:include>
			</div>
			<!-- end plugin: menus.topnav-include -->
		</nav><!-- /.container -->
	</div><!-- /.clearfix -->
</header>

<section id="slider">
	<?php smartInclude("search_bar.php");?>
  <%@ include file="/gadsdencounty/_includes_/center_content.jsp" %>
  <%@ include file="/gadsdencounty/_includes_/slider.jsp" %>
	<section id="quick-links">
		<div class="container">
      <%setText = "qlinks";%>
      <div class="<%=setText%>-btn">
        <%-- #BeginRZ-ActionImage --%>
        <script language="JavaScript" type="text/JavaScript">
          RZ.module = '<%=setText%>';
          RZ.recordid = RZ.editrecordid;
          RZ.nexturl = "editforms/<%=setText%>-links-editlist.jsp";
          RZ.img = '<span class="rzBtn">Edit This List</span>';
          RZ.caption = '';
          RZ.options = '';
          if (typeof RZaction != 'undefined') RZaction('editlist');
        </script><%-- #EndRZ-ActionImage --%>
      </div><!--<%=setText%>-btn-->
      <% StringBuffer qlinksBfr = new StringBuffer();%>
      <rz:list module="<%=setText%>" sort="seq_no asc" output="none" options="" filter="">
        <% while(rz.listnext()){ %>
          <rz:listbody>
      <rz:fetch module="<%=setText%>" field="image" output="none" options="image,auto,location=/,extensions=,align=,maxwidth=82,maxheight=78" />
      <% imageArr = getImage(rz.src, rz.alt, "./_assets_/images/briefcase.png");%>
      <rz:fetch module="<%=setText%>" field="url" output="none" options="size=30,wrap=Virtual"/>
      <%
              linkInfo = getLink(rz.content, rz.webspace);
              qlinksBfr.append("<a href=\""+linkInfo[0]+"\" target=\""+linkInfo[1]+"\" class=\"quick-link\">\n");
              qlinksBfr.append("<img src="+imageArr[0]+" alt="+imageArr[1]+">\n");
              qlinksBfr.append("<span class=\"quick-link-title\">"+rz.fetch(setText, "text")+"</span>\n");
              qlinksBfr.append("</a><!--/.quick-link-->\n");
            %>
      </rz:listbody>
        <%}%>
      </rz:list>
			<div class="quick-links-carousel">
				<%=qlinksBfr%>
			</div><!-- /.quick-links-carousel -->
		</div><!-- /.container -->
	</section><!-- /#quick-links.owl-carousel -->
</section><!-- /#slider -->

<main id="main">
	<section id="news">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
          <%-- #BeginRZ-ActionImage --%>
					<%setText = "event_header";%>
					<div class="<%=setText%>-btn">
					  <script language="JavaScript" type="text/JavaScript">
					    RZ.module = 'global';
					    RZ.nexturl = 'editforms/double-caption-editform.jsp';
					    RZ.img = '<span class="rzBtn">Edit Header</span>';
					    RZ.set = 'global.pageid=<%=setText%>';
					    RZ.options = '';
					    if (typeof RZaction != 'undefined') RZaction('editform');
					  </script>
					</div><!-- /.<%=setText%>-btn -->
					<%-- #EndRZ-ActionImage --%>
          <rz:fetch module="global" field="short_text" output="none" where="<%="global.pageid=" + setText%>"/>
<% String topNews = rz.content.equals("") ? "find out what's happening..." : rz.content;%>
          <rz:fetch module="global" field="short_text2" output="none" where="<%="global.pageid=" + setText%>"/>
<% String bottomNews = rz.content.equals("") ? "news stories + announcements" : rz.content;%>
					<h2><span><%=topNews%></span><br><%=bottomNews%></h2>
				</div>
				<div class="col-md-4">
					<div>
						<a href="newslist.php" class="btn">view archives</a>
					</div>
				</div>
			</div><!-- /.row -->
      <div class="newslinkbtn">
				  <%-- #BeginRZ-ActionImage --%>
				  <script language="JavaScript" type="text/JavaScript">
				    RZ.module = 'news';
				    RZ.nexturl = "editforms/news-links-editlist.jsp";
				    RZ.img = '<span class="rzBtn">Edit This List</span>';
				    RZ.caption = '';
				    RZ.options = '';
				    if (typeof RZaction != 'undefined') RZaction('editlist');
				  </script><%-- #EndRZ-ActionImage --%>
				</div>
				<% StringBuffer newsBfr = new StringBuffer(); %>
				<rz:list module="news" sort="date desc, seq_no asc" output="none" options="" filter="">
				  <% while(rz.listnext() && rz.listindex < 10){ %>
				    <rz:listbody>
        <rz:fetch module="news" field="image" output="none" options="image,auto,location=/,extensions=,align=,maxwidth=340,maxheight=220" />
        <% imageArr = getImage(rz.src, rz.alt, "./_assets_/images/news1.jpg");%>
        <rz:fetch module="news" field="date" output="none" options="size=30,wrap=Virtual" format="MMMM dd, yyyy"/>
        <%
				        caption_date = !("").equals(rz.content) ? ""+rz.content+"" : "";
				        if(!("").equals(rz.fetch("news","news_detail"))){
				      %>
        <rz:link template="news_detail" module="news" field="news_header" output="none"></rz:link>
        <%
				        link = rz.src;
				        newsBfr.append("<a href=\""+link+"\" class=\"news-link\">\n");
				      } else {
				        newsBfr.append("<a href=\"#\" class=\"news-link\">\n");
				      }
                newsBfr.append("<div style=\"background: url('"+imageArr[0]+"') center no-repeat; background-size: cover;\" class=\"news-link-icon\"></div>");
                newsBfr.append("<span class=\"news-date\">"+caption_date+"</span>\n");
                newsBfr.append("<h3 class=\"news-link-title\">"+rz.fetch("news", "news_header")+"</h3>\n");
                newsBfr.append("</a><!--/.news-link-->\n");
				      %>
        </rz:listbody>
				  <%}%>
				</rz:list>
			<div id="news-links" class="owl-carousel">
				<%=newsBfr%>
			</div><!-- /#news-links.owl-carousel -->
		</div><!-- /.container -->
	</section>
	<div class="clearfix blue-background">
		<div class="container">
			<div class="row">
				<div class="col-md-7">
					<section id="events">
						<div class="row">
							<div class="col-md-7">
                <%-- #BeginRZ-ActionImage --%>
								<%setText = "events_header";%>
								<div class="<%=setText%>-btn">
								  <script language="JavaScript" type="text/JavaScript">
								    RZ.module = 'global';
								    RZ.nexturl = 'editforms/double-caption-editform.jsp';
								    RZ.img = '<span class="rzBtn">Edit Header</span>';
								    RZ.set = 'global.pageid=<%=setText%>';
								    RZ.options = '';
								    if (typeof RZaction != 'undefined') RZaction('editform');
								  </script>
								</div><!-- /.<%=setText%>-btn -->
								<%-- #EndRZ-ActionImage --%>
                <rz:fetch module="global" field="short_text" output="none" where="<%="global.pageid=" + setText%>"/>
<% String topEvent = rz.content.equals("") ? "join the community..." : rz.content; %>
                <rz:fetch module="global" field="short_text2" output="none" where="<%="global.pageid=" + setText%>"/>
<% String bottomEvent = rz.content.equals("") ? "upcoming events" : rz.content; %>
								<h2><span><%=topEvent%></span><%=bottomEvent%></h2>
							</div>
							<div class="col-md-5 clearfix">
								<div class="calendar-btn">
									<a href="calendar.php" class="btn">master calendar</a>
								</div><!-- /.pull-right -->
							</div><!-- /.col-md-5.clearfix -->
						</div><!-- /.row -->
						<div class="row">
              <!-- Calendar Section Starts-->
						  <div class="calendarEventPopup">
						    <script>
							        window.addEventListener('message', function(e) {
							          var $iframe = jQuery("#calendarEvent");
							          var eventName = e.data[0];
							          var data = e.data[1];
							          switch(eventName) {
							            case 'setHeight':
							              $iframe.height(data);
							              break;
							          }
							        }, false);
							      </script>
							      <style>
							          @media only screen and (max-width:768px){iframe#calendarEvent{height:auto!important}}
							          @media only screen and (max-height:700px){iframe#calendarEvent{height:auto!important}}
							      </style>
							      <div id="RZcalendar_detail" style="display:none;z-index:9999;position:relative;visibility:hidden">
							      <div class="calendarEvent-overlay" style="position:fixed;top:0;right:0;bottom:0;left:0;width:100%;z-index:10;background-color:rgba(0,0,0,.6)"></div>
							      <!-- /.calendarEvent-overlay -->
							      <iframe src="about:blank" id="calendarEvent" style="position:fixed;z-index:9999;top:5%;right:0;width:600px;min-height:370px;max-width:100%;border:0"></iframe>
							      </div>
							      <!-- /#RZcalendar_detail -->
							  </div>
							  <!-- /.calendarEventPopup -->
							<!-- Calendar Section Ends-->
							<jsp:include page="/plugins/calendar/calendar.iframe.template_include.jsp">
                <jsp:param name="name" value="" />
                <jsp:param name="width" value="450" />
                <jsp:param name="height" value="300" />
                <jsp:param name="date" value="" />
                <jsp:param name="view" value="mini" />
                <jsp:param name="htmlfile" value="calendar_mini_base.html" />
                <jsp:param name="cssfile" value="calendar_mini_gadsdencounty.css" />
							</jsp:include>
						</div><!-- /.row -->
					</section><!-- /#events -->
				</div><!-- /.col-md-7 -->
				<div class="col-md-5">
					<section id="facebook" class="fillRight withPadding">
            <%-- #BeginRZ-ActionImage --%>
						<% setText = "facebook_template"; %>
						<div class="<%=setText%>-btn">
						  <script language="JavaScript" type="text/JavaScript">
						    RZ.module = 'global';
						    RZ.nexturl = 'editforms/template-editform.jsp';
						    RZ.img = '<span class="rzBtn">Edit Text Section</span>';
						    RZ.set = 'global.pageid=<%=setText%>';
						    RZ.options = '';
						    if (typeof RZaction != 'undefined') RZaction('editform');
						  </script>
						</div><!-- /.<%=setText%>-btn -->
						<%-- #EndRZ-ActionImage --%>
            <rz:fetch module="global" field="short_text" output="none" where="<%="global.pageid=" + setText%>"/>
<% String topFacebook = rz.content.equals("") ? "stay updated..." : rz.content;%>
            <rz:fetch module="global" field="short_text2" output="none" where="<%="global.pageid=" + setText%>"/>
<% String bottomFacebook = rz.content.equals("") ? "connect with us" : rz.content;%>
						<h2><span><%=topFacebook%></span> <%=bottomFacebook%></h2>
						<div id="social-feed"></div>
            <rz:fetch module="global" field="short_text3" output="none" where="<%="global.pageid=" + setText%>"/>
<% content = rz.content.equals("") ? "./" : rz.content;%>
						<a href="<%=content%>">go to gadsden co. facebook</a>
					</section><!-- /#facebook -->
				</div><!-- /.col-md-5 -->
			</div><!-- /.row -->
		</div><!-- /.container -->
	</div><!-- /.clearfix -->
	<section id="interests">
    <%-- #BeginRZ-ActionImage --%>
		<%setText = "interests_container";%>
		<div class="<%=setText%>-btn">
		  <script language="JavaScript" type="text/JavaScript">
		    RZ.module = 'global';
		    RZ.nexturl = 'editforms/image-editform.jsp';
		    RZ.img = '<span class="rzBtn">Edit Image Background</span>';
		    RZ.set = 'global.pageid=<%=setText%>';
		    RZ.options = '';
		    if (typeof RZaction != 'undefined') RZaction('editform');
		  </script>
		</div><!-- /.<%=setText%>-btn -->
		<%-- #EndRZ-ActionImage --%>
    <rz:fetch module="global" field="image" output="none" where="<%="global.pageid=" + setText%>" options="image,auto,location=,extensions=,align="/>
<%imageArr = getImage(rz.src, rz.alt, "_assets_/images/footer.jpg");%>
    <style>#interests::before{background:url(<%=imageArr[0]%>) center / cover no-repeat;}</style>
		<div class="container">
			<div class="interests-overlay"></div>
      <%-- #BeginRZ-ActionImage --%>
			<%setText = "interests_image";%>
			<div class="<%=setText%>-btn">
			  <script language="JavaScript" type="text/JavaScript">
			    RZ.module = 'global';
			    RZ.nexturl = 'editforms/interested-editform.jsp';
			    RZ.img = '<span class="rzBtn">Edit Image Section</span>';
			    RZ.set = 'global.pageid=<%=setText%>';
			    RZ.options = '';
			    if (typeof RZaction != 'undefined') RZaction('editform');
			  </script>
			</div><!-- /.<%=setText%>-btn -->
			<%-- #EndRZ-ActionImage --%>
      <rz:fetch module="global" field="image" output="none" where="<%="global.pageid=" + setText%>" options="image,auto,location=,extensions=,align="/>
<%imageArr = getImage(rz.src, rz.alt, "./_assets_/images/interest.jpg");%>
			<div class="interests-banner col-md-5" style="background: url('<%=imageArr[0]%>') center no-repeat; background-size: cover; z-index: 1">
        <rz:fetch module="global" field="short_text" output="none" where="<%="global.pageid=" + setText%>"/>
<% String interestHeader = rz.content.equals("") ? "explore gadsden county" : rz.content; %>
        <rz:fetch module="global" field="short_text2" output="none" where="<%="global.pageid=" + setText%>"/>
<% String interestSubHeader = rz.content.equals("") ? "areas of interest" : rz.content; %>
				<h2><span><%=interestHeader%></span> <%=interestSubHeader%></h2>
			</div><!-- /.interest-banner.pull-left -->
      <%setText = "interests";%>
			<div class="<%=setText%>-btn">
			  <%-- #BeginRZ-ActionImage --%>
			  <script language="JavaScript" type="text/JavaScript">
			    RZ.module = '<%=setText%>';
			    RZ.recordid = RZ.editrecordid;
			    RZ.nexturl = "editforms/<%=setText%>-links-editlist.jsp";
			    RZ.img = '<span class="rzBtn">Edit This List</span>';
			    RZ.caption = '';
			    RZ.options = '';
			    if (typeof RZaction != 'undefined') RZaction('editlist');
			  </script><%-- #EndRZ-ActionImage --%>
			</div><!--<%=setText%>-btn-->
			<% StringBuffer interestsBfr = new StringBuffer();%>
			<rz:list module="<%=setText%>" sort="seq_no asc" output="none" options="" filter="">
			  <% while(rz.listnext()){ %>
			    <rz:listbody>
      <rz:fetch module="<%=setText%>" field="url" output="none" options="size=30,wrap=Virtual"/>
      <%
			        linkInfo = getLink(rz.content, rz.webspace);
			        interestsBfr.append("<li class=\"interests-link\">\n");
              interestsBfr.append("<a href=\""+linkInfo[0]+"\" target=\""+linkInfo[1]+"\">"+rz.fetch(setText, "text")+"</a>\n");
              interestsBfr.append("</li>\n");
			      %>
      </rz:listbody>
			  <%}%>
			</rz:list>
			<ul class="interests-links col-md-7">
				<%=interestsBfr%>
			</ul><!-- /.interests-links -->
		</div><!-- /.container -->
	</section>
	<?php smartInclude("footer_links.php");?>
</main>
<footer>
	<div class="text-center">
    <?php smartInclude("copyright.php");?>
    <%@ include file="/gadsdencounty/_includes_/login.jsp" %>
	</div>
</footer>
<?php smartInclude("alert.php");?>
<!-- Share widget make into an include file -->
<?php smartInclude("share_widget.php");?>
<!-- Share widget make into an include file -->


<script src="_assets_/js/jquery.min.js"></script>
<script src="_assets_/plugins/social-feed/bower_components/codebird-js/codebird.js"></script>
<script src="_assets_/plugins/social-feed/bower_components/doT/doT.min.js"></script>
<script src="_assets_/plugins/social-feed/bower_components/moment/min/moment.min.js"></script>
<script src="_assets_/plugins/social-feed/bower_components/moment/locale/en-au.js"></script>
<script src="_assets_/plugins/social-feed/js/jquery.socialfeed.js"></script>
<script src="_assets_/plugins/modernizr/modernizr.custom.js"></script>
<script src="_assets_/plugins/owl.carousel/owl-carousel/owl.carousel.min.js"></script>
<script src="_assets_/plugins/jquery.bxslider/jquery.bxslider.min.js"></script>
<script src="_assets_/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="_assets_/plugins/revizeWeather/js/revizeWeather.min.js"></script>
<script src="_assets_/js/scripts.js"></script>
<%@ include file="/util/setup_template_before_endbody.jsp" %>
</body>
</html>