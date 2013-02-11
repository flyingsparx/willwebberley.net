<h1>Basic Overall CV</h1>

<button class="print-button">Print CV</button>
<button class="mailto-button">Email CV</button>

<hr />

<!-- Start print area -->
<div id="print-area">

<div class="print-head">
	<h1>Will Webberley - Basic Curriculum Vitae</h1>
	<p>Printed from the up-to-date version at <span style="text-decoration:underline">willwebberley.net/cv</span> on <? echo date("d/m/Y"); ?>.</p>
        <hr />
</div>

<h2>Personal details</h2>
<p><label>Name</label>Will M Webberley</p>
<p><label>Email</label>will@willwebberley.net</p>
<p><label>Address</label>Available on request</p>
<p><label>Phone</label>Available on request</p>
<p><label>D.O.B.</label>Available on request - currently age 24</p>
<p><label>Driving license</label>Full UK</p>

<hr />
<h2>Education</h2>

<h3>PhD Computer Science</h3>
<p><label>Date achieved</label>Currently undergoing (started October 2010)</p>
<p><label>Institution</label>Cardiff University, UK</p>

<h3>BSc Computer Science</h3>
<p><label>Degree class</label>1st class honours</p>
<p><label>Date achieved</label>July 2010</p>
<p><label>Institution</label>Cardiff University, UK</p>

<h3>A'-Levels</h3>
<p><label>Subjects</label>Biology</p>
<p><label>&nbsp;</label>Chemistry</p>
<p><label>&nbsp;</label>Maths</p>
<p><label>&nbsp;</label>Phsyics (to AS)</p>
<p><label>Date achieved</label>June 2007</p>
<p><label>Institution</label>King's School, Worcester, UK</p>

<hr />
<h2>Publications</h2>

<h3>Retweeting: A Study of Message-Forwarding in Twitter</h3>
<p><label>Authors</label>Will Webberley, Stuart Allen & Roger Whitaker</p>
<p><label>Reviewed</label>Double-blind peer-reviewed</p>
<p><label>Date</label>September 2011</p>
<p><label>Conference</label>MOSN'11 (First Workshop on Mobile and Online Social Networks), Milan, Italy</p>
<p><label>Published by</label>IEEE</p>


<hr />
<h2>Skillset</h2>

<h3>Technical skills</h3>
<p>Whilst always very keen to learn new skills and processes, I am currently proficient in the following.</p>
<p><label>Programming</label>Python, Java, C / C++, BASH</p>
<p><label>Web Languages</label>PHP, CGI, JavaScript (along with JQuery), HTML, CSS</p>
<p><label>General</label>LaTeX, MySQL (and other variants), MATLAB, other scientific and analytic libraries</p>

<p>In addition, I have more limited knowledge, which I hope to expand, in the following.</p>
<p><label>Programming</label>Perl, Ruby (both in terms of web applications also)</p>
<p><label>Frameworks</label>Django, node.js</p>

<h3>Soft skills</h3>
<p>I have excellent team-working skills, I'm confident when talking to others and am enthusiastic to hear what others have to say. I am a social person, and feel that good, friendly bonds between people are important in team environments.</p>


<hr />
<h2>Teaching Experience</h2>
<p>As part of my PhD, I've taught in the School of Computer Science and Informatics at Cardiff University. Teaching enabled me to gain experiences and skills in speaking and instructing in front of large groups of people, providing a positive atmosphere for others to work in and in giving construcitve feedback.</p>
<p>Assessments have allowed me to gain insights into how other people understand how different processes work, and how people can sometimes understand things slightly differently.</p>
<p>Areas I've taught in include Java, Python, Assembly Language, system design (UML, etc.), project management, mobile communications, business processes, algorithmic programming, important professional skills, and so on. I've also had an opportunity to supervise serveral year-long projects carried out by teams of around 6-10 people, enabling me to gain more skills in project management, and more well-rounded experiences all round.</p>
<p>As a whole, it's been incredibly useful to me in many ways, including being able to consolidate my own knowledgee in these areas, and also to keep on top of emerging technologies and processes.</p>


<hr />
<h2>Past Employment</h2>

<h3>Cardiff University</h3>
<p><label>Date</label>September 2010 &rarr; present</p>
<p><label>Role</label>Tutor</p>
<p><label>Responsibilities</label>Taught labs and tutorial classes to undergraduate (years 1-3) and masters students in many fields of computer science and informatics. Please see above section for more information.</p>

<h3>Abercrombie & Fitch Co.</h3>
<p><label>Date</label>February 2010 &rarr; September 2010</p>
<p><label>Role</label>Hollister Impact Team</p>
<p><label>Reason for leaving</label>Full time PhD to start</p>
<p><label>Responsibilities</label>Responsible for organising the shop floor, receiving and oragnising shipments, keeping track of stock and replenishment. Skills gained included communication accross teams in a multi-discipline environment, precise organisation and being accurate with stock.</p>

<h3>Pulse Nightclub</h3>
<p><label>Date</label>August 2009 &rarr; December 2009</p>
<p><label>Role</label>Bar Staff</p>
<p><label>Reason for leaving</label>Very late nights were too much for final-year University student!</p>
<p><label>Responsibilities</label>Bar work as part of a vibrant and outgoing team. Direct contact with customers helped improve communication and teamwork skills, confidence, quick-thinking in a very fast-paced environment and over prolonged lengths of time. Responsible also for the supervision of new members of staff.</p>

<!-- End print area -->
</div>

<script type="text/javascript">

function printStuff(data) {
        //var mywindow = window.open('', 'Will Webberley: CV', 'height=400,width=600');
        var mywindow = window.open();
        mywindow.document.write('<html><head><title>Will Webberley: CV</title>');
        //mywindow.document.write('<link rel="stylesheet" href="http://www.willwebberley.net/includes/css/print-styles.css" type="text/css" />');
        mywindow.document.write('<style>*{font-family:\'Helvetica Neue\', \'Helvetica\', \'Sans-serif\';font-weight: 300;}h2{font-weight:heavy;text-decoration:underline;}p{color:black;}label{font-style:italic;width:120px;float:left;font-size:12px;color:gray;}.print-head{display:block;}</style>');
        mywindow.document.write('</head><body >');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');
        mywindow.print();
        mywindow.close();

        return true;
}

function emailStuff(){
    var emailLink = "mailto:hello@example.com"
             + "?subject=" + escape("Will Webberley - CV")
             + "&body=" + escape('Will Webberley\'s CV: http://www.willwebberley.net/cv')
    ;
    var mywindow = window.open();
    mywindow.location.href = emailLink;
}

$(".print-button").click(function(){
	printStuff($("#print-area").html());
});
$(".mailto-button").click(function(){
	emailStuff();
});
</script>