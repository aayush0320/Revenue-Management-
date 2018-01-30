<?php include 'include/head.html';?>
<link rel="stylesheet" href="css/separate/pages/others.min.css">
</head>
<body class="with-side-menu-addl-full">
<!--<body class="with-side-menu-compact">-->
<!--<body class="with-side-menu-compact with-side-menu-addl">-->

	<?php 
		include 'include/header.php';
		include 'include/sidebar.php';
	?>

	<nav class="side-menu-addl">
		<ul class="side-menu-addl-list">
			<ul class="side-table-of-contents">

				<li><a href="#introduction">Introduction</a></li>
				<li><a href="#Pages">Pages</a>
					<ul>
						<li><a href="#Proposal-List">Proposal List</a></li>
						<li><a href="#Proposal-Create">Proposal Create</a></li>
						<li><a href="#Reports">Reports</a></li>
					</ul>
				</li>	
				<li><a href="#FAQ">FAQs</a></li>
				<li><a href="#Error">Error Codes</a></li>
			</ul>
		</ul>
	</nav><!--.side-menu-->

	<div class="page-content">
		<div class="container-fluid">
			<div class="box-typical box-typical-padding documentation">
				
				<div class="text-block text-block-typical">
					<h2 id="introduction">Introduction to Nielsen Proposal Management</h2>
					<p>
						This is a smart proposal management and revenue recognition system which is capable of handling proposal generation, maintenance and reports for contract creation. 
					</p>
				</div>

				<hr>

				<div class="text-block text-block-typical">
					<h2 id="Pages">Pages</h2>
					<p>Various Pages available to the Employee depending on their roles are</p>
				</div>

					<p class="m-l-lg">
						<b>/proposal-list</b> - shows a list of proposal under the employee's team/s.
					</p>
					<p class="m-l-lg">
						<b>/proposal-create</b> - creates a new proposal.
					</p>
					<p class="m-l-lg">
						<b>/reports</b> - contains a list of proposal under employee's office.
					</p>
					<p class="m-l-lg">
						<b>/documentation</b> - contains FAQs and help for the employee.
					</p>
					<p class="m-l-lg">
						<b>/proposal-view</b> - shows the generated report.
					</p>	
					<p class="m-l-lg">
						<b>/error</b> - contains Error code and message whensoever an error occurs in the system.
					</p>						
					
					<br>

				<div class="text-block text-block-typical">
					
					<h4 id="Proposal-List">Proposal List</h4>
					<p>
						Employee can <code>create/copy/view/archive</code> proposals through this page based on his/her designation and roles assigned.
						<small>(Some features may or may not be available based on the employee designation.)</small>
					</p>
					<img src="img/plist.png" width="100%"><br/><br/>

					<h4 id="Proposal-Create">Proposal Create</h4>
					<p>
						Employees with designation CS can <code>create/edit</code> the proposal in detail through this page. Various activities such as <code>adding/removing</code> products and <code>EoA upload</code> can be done in this page.
					</p>
					<img src="img/pcreate.png" width="100%"><br/><br/>

					<h4 id="Reports">Reports</h4>
					<p>
						Employee can <code>view/generate report/export</code> the proposals to which office he belongs through this page.
					</p>
					<img src="img/reports.png" width="100%"><br/><br/>

					<h4 id="Proposal-View">Proposal View</h4>
					<p>
						Employee can <code>view/print</code> the report generated through this page.
					</p>	
					<img src="img/report.png" width="100%"><br/><br/>

					<h4 id="Error-Page">Error Page</h4>
					<p>
						Using the error code and message found in this page employee can try to resolve the problem.
					</p>	
					<img src="img/error.png" width="100%"><br/><br/>

				</div>

				<hr>

				<div class="text-block text-block-typical">
					<h2 id="FAQ">FAQ's</h2>
					<p>Some of the Frequently Asked Questions are mentoned below:</p>
				</div>

				<article class="faq-item">
					<div class="faq-item-circle">1</div>
					<h4>How to edit some proposal?</h4>
					<p>
						Click on the pencil icon <code><span class="fa fa-pencil"></span></code> on the proposal-list page to edit the required proposal.
					</p>
				</article>

				<article class="faq-item">
					<div class="faq-item-circle">2</div>
					<h4>Why can't I edit some proposal?</h4>
					<p>
						For employee be able to edit any proposal, he/she should have appropriate role assigned. There would be no option available to edit if the employee dosn't have the required privileges.   
					</p>
				</article>

				<article class="faq-item">
					<div class="faq-item-circle">3</div>
					<h4>How can I create a new proposal?</h4>
					<p>
						For employee be able to create a proposal, he/she have to be a CS Executive.<br>Employee can create a new proposal by clicking on the <code>Create New Proposal</code> button on the proposal-list page as shown below.   
					</p>
					<img src="img/faq3.png" width="100%"><br><br>
				</article>

				<article class="faq-item">
					<div class="faq-item-circle">4</div>
					<h4>How can I export the give data?</h4>
					<p>
						Any Employee can export the data by clicking on the Export icon <code><span class="font-icon-download"></span></code> on the toolbar available and selecting the desired format as shown below.	
					</p>
					<img src="img/faq4.gif" width="100%"><br><br>
					<p>
						Other toolbar icons:
							<ul>
							<li style="margin-top: 6px"><code style="padding-top: 6px"><span class="font-icon-arrow-square-down"></span></code>&emsp;Show Pagination</li>
							<li style="margin-top: 6px"><code style="padding-top: 6px"><span class="font-icon-arrow-square-down up"></span></code>&emsp;Hide Pagination</li>
							<li style="margin-top: 6px"><code style="padding-top: 6px"><span class="font-icon-list-square"></span></code>&emsp;Toggle Mobile View</li>
							<li style="margin-top: 6px"><code style="padding-top: 6px"><span class="font-icon-list-rotate"></span></code>&emsp;Choose Columns</li>
							</ul>
					</p>
				</article>

				<hr>

				<div class="text-block text-block-typical">
					<h2 id="Error">Error Manual</h2>
				</div>

				<table class="table font-16">
					<thead>
					<tr>
						<th>Error Code</th>
						<th>Description</th>
					</tr>
					</thead>
					<tbody>
					<tr>
						<td><code>951</code></td>
						<td>Error occured while inactivating Adhoc &amp; Subscription Services.</td>
					</tr>
					<tr>
						<td><code>952</code></td>
						<td>Error occured while inactivating Onetime &amp; Track Services.</td>
					</tr>
					<tr>
						<td><code>953</code></td>
						<td>Error occured while fetching Services.</td>
					</tr>
					<tr>
						<td><code>954</code></td>
						<td>Error occured while storing Adhoc Service Product details.</td>
					</tr>
					<tr>
						<td><code>955</code></td>
						<td>Error occured while storing Subscription Service Product details.</td>
					</tr>
					<tr>
						<td><code>956</code></td>
						<td>Error occured while storing Onetime Service Product details.</td>
					</tr>
					<tr>
						<td><code>957</code></td>
						<td>Error occured while storing Track Service Product details.</td>
					</tr>
					<tr>
						<td><code>958</code></td>
						<td>Error occured while updating Proposal's data.</td>
					</tr>
					<tr>
						<td><code>959</code></td>
						<td>Error occured while updating Services.</td>
					</tr>
					<tr>
						<td><code>960</code></td>
						<td>Error occured while storing the Proposal.</td>
					</tr>
					</tbody>
				</table>

			</div><!--.box-typical-->
		</div><!--.container-fluid-->
	</div><!--.page-content-->

	<?php include 'include/commonjs.html';?>
</body>
</html>