<!-- LIBS -->
<script type="text/javascript" src="js/prototype.js"></script>
<script type="text/javascript" src="js/tablekit.js"></script>
<!-- ENDLIBS -->
<script>
function hilite(elem)
{
	elem.style.background = '#FFC';
}

function lowlite(elem)
{
	elem.style.background = '';
}
</script>
<!--</head>-->

<body>
<div class="mainbar">
         <?php
          $total_count = DB::GetOne("SELECT COUNT(*) AS total_count FROM employee");   
          $pagination = new Pagination();
          $pagination->total_items = $total_count[0];
          $pagination->mid_range = 3;
          $pagination->paginate();
          echo "<br />Total Employees : <b>$total_count[0]</b> <br /><br /><br />";
          echo $pagination->displayPages();
          echo "<span class=\"\">&nbsp;&nbsp;".$pagination->displayJumpMenu()."&nbsp;&nbsp;".
          $pagination->displayItemsPerPage()."</span>";
          ?>
        <div id="employee_div" class="article">
          <br />
           <table id="employee" class="sortable resizable editable">
				<thead>
					<tr>
                    <th class="nosort nocol noedit" id="action">Delete Record</th>
                    <th class="sortfirstdesc sortcol sortasc" id="firstname">First Name</th>
                    <th class="sortcol" id="lastname">Last Name</th>
                    <th class="sortcol" id="email">Email</th>
                    <th class="sortcol" id="passwd">Password</th>
                    <th class="sortcol" id="id_profile">Profile</th>
                    <th class="sortcol" id="active">Status</th>
                    </tr>
                </thead>
				<tfoot>
					<tr>
                    <td>Delete Record</td>
                    <td>First Name</td>
                    <td>Last Name</td>
                    <td>Email</td>
                    <td>Password</td>
                    <td>Profile</td>
                    <td>Status</td>
                    </tr>
				</tfoot>
                
				<tbody id="employee_body">
                  
                  <?php
                  if($total_count[0] > 0) {
                  $stmt = DB::getInstance()->query("SELECT * FROM employee LEFT OUTER JOIN profile on employee.id_profile = profile.id_profile order by id_employee asc ".$pagination->limit);                                   
                  $i=1;
                  while($row = $stmt->fetch(PDO::FETCH_ASSOC)) : 
                  ?>
                    <tr class="<?php echo ($i % 2 == 0) ? 'rowodd' : 'roweven'; ?>" id="<?php echo $row['id_employee']; ?>" onmouseover="hilite(this);" onmouseout="lowlite(this);">
                    <td>
                    <img src="images/delete.gif" />
                    <a class="delete" href="#" onclick="deleteRecord(<?php echo $row['id_employee']; ?>); return false">delete</a>
                    </td>
                    <td><?php echo $row['firstname']; ?></td>
                    <td><?php echo $row['lastname']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo substr($row['passwd'], 0, 10); ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo ($row['active'] == 1) ? "Active" : "Not Active"; ?></td>
                    </tr>
                  <?php                  
                  $i++;
                  endwhile;
                  }
                  else
                  {
                    echo "<tr><td colspan='4' class='nocol'>
                    <font color='red'>All Employees Deleted</font>
                    </td></tr>";
                  }
                  DB::Close();
                  ?>
                  
                  <?php
                  $stmtProf = DB::getInstance()->query("SELECT DISTINCT * FROM profile order by id_profile asc");
                  $profiles = "";
                  while($profile = $stmtProf->fetch(PDO::FETCH_ASSOC))
                  {
                    $profiles .= "['$profile[name]','$profile[id_profile]'],";
                    //$profiles .= "'$profile[id_profile]'],";
                  }
                  DB::Close();
                  ?>

               </tbody>
			</table><br />
			<div class="panel" id="doco-editable"> </div>						
		</div>

		<script type="text/javascript">
		
			TableKit.options.editAjaxURI = 'includes/transaction.php';
            
            TableKit.Editable.selectInput('id_profile', {}, [
						<?php echo $profiles; ?>									
					]);
            
            TableKit.Editable.selectInput('active', {}, [
						['Active','1'],
						['Not Active','2']
					]);
		</script>
          <p>
<script type="text/javascript" charset="utf-8">
  var users_table = new TableKit( 'employee', {
    editAjaxURI: 'includes/transaction.php'
  });
  
/*  function addUser() {
    var timestamp = new Date().getTime();
    var new_table = 'patient' + timestamp;
    var url = 'transaction/addPatient' + '?timestamp=' + timestamp;
    new Ajax.Updater( 'article', url, { 
      asynchronous: true,
      onComplete: function() {
        new TableKit( new_table, {
          editAjaxURI: 'mainbar.php'
        })
      }
    });
  }*/
  
  function deleteRecord( id_record ) {
    var timestamp = new Date().getTime();
    var new_table = 'employee' + timestamp;
    var url = 'includes/transaction.php' + '?id_delete=' + id_record + '&table_delete=employee' + '&timestamp=' + timestamp;
    var answer = confirm('Are you sure you want to delete this employee?');
    if (answer) {
      new Ajax.Updater( 'employee_div', url, { 
        asynchronous: true,
        onComplete: function() {
          new TableKit( new_table, {
            editAjaxURI: 'includes/transaction.php'
          })
        }
      });
    }
  }
</script>
           <?php
           echo $pagination->displayPages();
           echo "<p class=\"paginate\">Page: <b>$pagination->current_page</b> of <b>$pagination->num_pages</b></p>\n"; 
          ?>
        </div>
      </div>