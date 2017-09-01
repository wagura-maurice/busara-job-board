<?php

/**
 * User Class - user class for Busara - JobBoard project.
 * PHP Version 5
 * @package User Class
 * @author Wagura Maurice
 * @link https://www.waguramaurice.cf
 * @copyright 2017 Wagura Maurice
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 * @note This program is distributed in the hope that it will be useful - WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.
 */

class userClass {

	private $_db;

	public function __construct($connection) {
	// parent::__construct();

		$this->_db = $connection;
	}

	public function register($email, $password, $company, $companyLogo, $active) {

		$Query  = "INSERT INTO `employer`(`email`, `password`, `company`, `logo`, `status`) VALUES ('$email', '$password', '$company', '$companyLogo', '$active')";

		if ($this->_db->query($Query) === TRUE) {
    		$action = "Success";
    	} else {
    		$action = "Failed";
    	}

		return "".SITEURL."/login.php?action=" . $action;
	}

	public function apply($em, $id, $fname, $lname, $email, $CV) {

		$Query  = "INSERT INTO `apply`(`employer_id`, `job_ID`, `fname`, `lname`, `email`, `CV`) VALUES ('$em', '$id', '$fname', '$lname', '$email', '$CV')";

		if ($this->_db->query($Query) === TRUE) {
    		$action = "Success";
    	} else {
    		$action = "Failed";
    	}

		return "".SITEURL."/job-details.php?x=" . $id . "&y=" . $em . "&action=" . $action;
	}

	public function postJob($tittle, $overview, $qualification, $responsibilities, $requirements, $category, $wType, $location, $deadline, $employer_id) {

		$Query  = "INSERT INTO `job`(`tittle`, `overview`, `qualification`, `responsibilities`, `requirements`, `category`, `wType`, `location`, `deadline`, `employer_id`) VALUES ('$tittle', '$overview', '$qualification', '$responsibilities', '$requirements', '$category', '$wType', '$location', '$deadline', '$employer_id')";

		if ($this->_db->query($Query) === TRUE) {
    		$action = "Success";
    	} else {
    		$action = "Failed";
    	}

		return "".SITEURL."/post-job.php?action=" . $action;
	}

	public function applyValid($id, $value) {

		$Query  = "SELECT `email` FROM `apply` WHERE `job_ID` = '$id' AND `email` = '$value'";
		$Result = $this->_db->query($Query);
		$Row    = $Result->fetch_assoc();

		return $Row['email'];
	}

	public function Login($email,$password) {

		$Query  = "SELECT `id` FROM `employer` WHERE `email` = '$email' AND `password` = '$password' AND `status` = 'active'";
		$Result = $this->_db->query($Query);

		if ($this->totalCount($Result) != 1) {
			return "".SITEURL."/login.php?login=invalid";
		} else {
		// Authenticated, set session variables
			$user = $Result->fetch_array();
			$_SESSION['userID']    = $user['id'];
			return $this->Router();
		}
	}

	public function employer($id, $value) {

		$Query  = "SELECT * FROM `employer` WHERE `id` = '$id'";
		$Result = $this->_db->query($Query);
		$Row    = $Result->fetch_assoc();

		return $Row[$value];
	}

	public function validator($id, $value) {

		$Query  = "SELECT `$id` FROM `employer` WHERE `$id` = '$value'";
		$Result = $this->_db->query($Query);
		$Row    = $Result->fetch_assoc();

		return $Row[$id];
	}

	public function jobDetail($id, $value) {

		$Query  = "SELECT `$value` FROM `job` WHERE `id` = '$id'";
		$Result = $this->_db->query($Query);
		$Row    = $Result->fetch_assoc();

		return $Row[$value];
	}

	public function jobs($value = NULL, $sql = NULL) {

		if ($sql != NULL) {
			$Query  = $sql;
		} else {
			$Query  = "SELECT * FROM `job` WHERE `deadline` > NOW() ORDER BY `id` DESC";
		}

		$Result = $this->_db->query($Query);

		if ($value == "Count") {
			return $this->totalCount($Result);
		} else {
			if($this->totalCount($Result) == 0) {
				return "
				<div class=\"job-list\" style=\"width: 100%;\">
					<div class=\"thumb\"><img src=\"assets/img/logo.png\" alt=\"".APPNAME."\"></div>
					<div class=\"job-list-content\">
						<h4 align=\"center\">No Jobs Available Currently, please try again later.</h4>
					</div>
				</div>";
			} else {
				$jobs = NULL;
				while($Row = $Result->fetch_assoc()) {
					$jobs .= "
					<div class=\"job-list\" style=\"width: 100%;\">
						<div class=\"thumb\">
							<a href=\"job-details.php?x=". $Row['id'] ."&y=". $Row['employer_id'] ."\"><img src=\"uploads/logos/". $this->employer($Row['employer_id'], 'logo') ."\" width=\"100px\" height=\"100px\" alt=\"".APPNAME."\"></a>
						</div>
						<div class=\"job-list-content\">
							<h4><a href=\"job-details.php?x=". $Row['id'] ."&y=". $Row['employer_id'] ."\">". ucwords($Row['tittle']) ."</a><span class=\"part-time\">". ucwords($Row['wType']) ."</span></h4>
							<p>". ucfirst($Row['overview']) ."</p>
							<div class=\"job-tag\">
								<div class=\"pull-left\">
									<div class=\"meta-tag\">
										<span><i class=\"ti-world\"></i>". ucwords($this->employer($Row['employer_id'], 'company')) ."</span>
										<span><i class=\"ti-location-pin\"></i>". ucwords($Row['location']) ."</span>
										<span><i class=\"ti-briefcase\"></i>". ucwords($Row['category']) ."</span>
									</div>
								</div>
								<div class=\"pull-right\">
									<a href=\"job-details.php?x=". $Row['id'] ."&y=". $Row['employer_id'] ."\" class=\"btn btn-common btn-rm\">More Detail</a>
								</div>
							</div>
						</div>
					</div>";
				}
				return $jobs;
			}
		}
	}

	public function jobGroups($list) {

        $Query  = "SELECT `$list` FROM `job` WHERE `deadline` > NOW() ORDER BY `id` DESC";
		$Result = $this->_db->query($Query);

		if($this->totalCount($Result) == 0) {
			return "<li><span class=\"num-posts\">0 Jobs</span></li>";
		} else {
			$Groups = [];
			while($Row = $Result->fetch_assoc()) {
				$Groups[] = $Row[$list];
			}

			$variable = array_unique($Groups);

			foreach ($variable as $key => $value) {
				echo "<li><a href=\"search.php?group=" . $value . "\">" . ucwords($value) . "<span class=\"num-posts\"> " . number_format($this->jobGroupCounts($list, $value)) . " Jobs</span></a></li>";
				}
		}
	}

	public function jobGroupCounts($list, $value) {

		$Query  = "SELECT COUNT(`$list`) AS `listCount` FROM `job` WHERE `$list` = '$value'";
		$Result = $this->_db->query($Query);
		$Row    = $Result->fetch_assoc();

		return $Row['listCount'];
	}

	public function loopOutJobs($value) {

		$Query  = "SELECT `$value` FROM `job` WHERE `deadline` > NOW() ORDER BY `id` DESC";
		$Result = $this->_db->query($Query);
		
		if($this->totalCount($Result) == 0) {
			return "No " . ucfirst($value) . "(s) Found";
		} else {
			$values = [];
			while($Row = $Result->fetch_assoc()) {
				$values[] = $Row[$value];
			}

			$variable = array_unique($values);
				foreach ($variable as $key => $value) {
					echo $values[] = "<option value=\"". $value ."\">". ucwords($value) ."</option>";
				}
		}
	}

	public function loggedIn() {

		if (isset($_SESSION['userID'])) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function Insession($value) {

		$Query  = "SELECT `$value` FROM `employer` WHERE `id` = " . $_SESSION['userID'];
		$Result = $this->_db->query($Query);
		$Row    = $Result->fetch_assoc();

		return $Row[$value];
	}

	public function Router() {

		if ($this->loggedIn() == TRUE) {
			return "".SITEURL."/index.php";
		} elseif ($this->loggedIn() == FALSE) {
			return "".SITEURL."/login.php";
		}
	}

	public function Logout() {

		$_SESSION = array();

		if(isset($_COOKIE[session_name()])) {
			setcookie(session_name(), '', time()-150000, '/');
		}

		session_unset();
		session_destroy();
	}

	public function totalCount($value){
		return $value->num_rows;
	}

	public function CleanEntries($entry) {

		$entry = trim($entry); // trim white space
		$entry = strtolower($entry); // convert all alphabetic characters to lowercase
		$entry = addslashes($entry); // escape by adding slashes on all special characters
		$entry = htmlspecialchars($entry); // escape any HTML entities or characters

		return $entry; // return a cleaned entry.
	}

	public function Redirect($url) {
		header("Location: {$url}");
	}

	public function jobCounts($value) {

		$Query  = "SELECT COUNT(`id`) AS `jobCounts` FROM `job` WHERE `employer_id` = '$value'";
		$Result = $this->_db->query($Query);
		$Row    = $Result->fetch_assoc();

		return $Row['jobCounts'];
	}

	public function applications($Query) {

		$Result = $this->_db->query($Query);

		if($this->totalCount($Result) == 0) {
			return "
			<div class=\"applications-content\"  align=\"center\">
				<div class=\"row\">
					<div class=\"col-md-12\">
						<div class=\"thums\">
							<img src=\"uploads/logos/". $this->Insession("logo") ."\" alt=\"".APPNAME."\">
						</div>
						<div class=\"job-list-content\">
						<h4>No Applications filed yet on the ". $this->jobCounts($this->Insession("id")) ." jobs so far posted, please post more jobs and offerings.</h4>
						</div>
					</div>
				</div>
			</div>";
		} else {
			$applications = NULL;
			while($Row = $Result->fetch_assoc()) {
				$applications .= "
				<div class=\"applications-content\"  align=\"center\">
					<div class=\"row\">
						<div class=\"col-md-5\">
							<div class=\"thums\">
								<img src=\"uploads/logos/". $this->Insession("logo") ."\" alt=\"".APPNAME."\">
							</div>
							<h3><a href=\"job-details.php?x=". $Row['job_ID'] ."&y=". $Row['employer_id'] ."\" target=\"_blank\">". ucwords($this->jobDetail($Row['job_ID'], "tittle")) ."</a></h3>
							<p><span>". ucwords($Row['fname']) ." ". ucwords($Row['lname']) ."</span></p>
						</div>
						<div class=\"col-md-3\">
							<p><span class=\"full-time\">". ucwords($this->jobDetail($Row['job_ID'], "wType")) ."</span></p>
							<p>". ucwords($this->jobDetail($Row['job_ID'], "category")) ."</p>
						</div>
						<div class=\"col-md-2\">
							<p>". (new DateTime ($Row['applyDate'])) -> format('M, dS Y') ."</p>
							<p><a href=\"uploads/resume/". $Row['CV'] ."\" target=\"_blank\"><button type=\"button\" class=\"btn btn-common\"> RESUME</button></a></p>
						</div>                   
						<div class=\"col-md-2\">
							<p><button type=\"button\" class=\"btn btn-common\" data-toggle=\"modal\" data-target=\"#accept". $Row['job_ID'] ."\"> ACCEPT</button></p>
							<p><button type=\"button\" class=\"btn btn-common\" data-toggle=\"modal\" data-target=\"#reject". $Row['job_ID'] ."\"> REJECT</button></p>
						</div>
					</div>
				</div>

				<div class=\"modal fade\" id=\"accept". $Row['job_ID'] ."\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"mySigninLabel\">
					<div class=\"modal-dialog modal-md\">
						<div class=\"modal-content\">
							<div class=\"modal-header\">
								<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"CLOSE\"><span aria-hidden=\"true\">&times;</span></button>
								<h4 class=\"modal-title\" id=\"myModalLabel\" align=\"center\">NOTIFY THE APPLICANT</h4>
							</div>
							<div class=\"modal-body\" style=\"padding:40px 40px;\">
								<form role=\"form\" class=\"login-form\" method=\"POST\" accept-charset=\"UTF-8\">
									<div class=\"form-group\">
										<div class=\"input-icon\">
											<i class=\"ti-email\"></i>
											<input type=\"email\" id=\"email\" class=\"form-control\" name=\"email\" value=\"". $Row['email'] ."\" placeholder=\"Applicants Email Address\" required readonly>
										</div>
									</div> 
									<div class=\"form-group\">
										<div class=\"input-icon\">
											<i class=\"ti-briefcase\"></i>
											<input type=\"text\" id=\"subject\" name=\"subject\" class=\"form-control\" value=\"". ucwords($this->jobDetail($Row['job_ID'], "tittle")) ."\" placeholder=\"Mail Subject\" required readonly>
										</div>
									</div>
									<div class=\"form-group\">
										<label class=\"control-label\" for=\"textarea\">Compose Mail</label>
										<div class=\"input-icon\">
											<i class=\"ti-info-alt\"></i>
											<textarea class=\"form-control\" rows=\"7\" name=\"message\" id=\"message\" required>Dear, ". ucwords($Row['fname']) ." ". ucwords($Row['lname']) .", We have received and ACCEPTED your application for ". ucwords($this->jobDetail($Row['job_ID'], "tittle")) .". We hereby invite you to a face to face interview at our offices in HQ on 12/27/2017 at 9:30 AM</textarea>
										</div>
									</div>
									<div class=\"form-group\">
										<hr>
									</div>
									<input type=\"hidden\" id=\"x\" name=\"x\" class=\"form-control\" value=\"ACCEPTED\" required readonly>
									<input type=\"hidden\" id=\"y\" class=\"form-control\" name=\"y\" value=\"". $Row['job_ID'] ."\" required readonly>
									<div class=\"form-group\" align=\"center\">
										<button type=\"submit\" name=\"mail\" id=\"mail\" class=\"btn btn-common\">SEND MAIL</button>
									</div>
								</form>
							</div>
							<div class=\"modal-footer\">
								<button type=\"button\" class=\"btn btn-border\" data-dismiss=\"modal\">Close</button>
							</div>
						</div>
					</div>
				</div>
				<div class=\"modal fade\" id=\"reject". $Row['job_ID'] ."\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"mySigninLabel\">
					<div class=\"modal-dialog modal-md\">
						<div class=\"modal-content\">
							<div class=\"modal-header\">
								<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"CLOSE\"><span aria-hidden=\"true\">&times;</span></button>
								<h4 class=\"modal-title\" id=\"myModalLabel\" align=\"center\">NOTIFY THE APPLICANT</h4>
							</div>
							<div class=\"modal-body\" style=\"padding:40px 40px;\">
								<form role=\"form\" class=\"login-form\" method=\"POST\" accept-charset=\"UTF-8\">
									<div class=\"form-group\">
										<div class=\"input-icon\">
											<i class=\"ti-email\"></i>
											<input type=\"email\" id=\"email\" class=\"form-control\" name=\"email\" value=\"". $Row['email'] ."\" placeholder=\"Applicants Email Address\" required readonly>
										</div>
									</div> 
									<div class=\"form-group\">
										<div class=\"input-icon\">
											<i class=\"ti-briefcase\"></i>
											<input type=\"text\" id=\"subject\" name=\"subject\" class=\"form-control\" value=\"". ucwords($this->jobDetail($Row['job_ID'], "tittle")) ."\" placeholder=\"Mail Subject\" required readonly>
										</div>
									</div>
									<div class=\"form-group\">
										<label class=\"control-label\" for=\"textarea\">Compose Mail</label>
										<div class=\"input-icon\">
											<i class=\"ti-info-alt\"></i>
											<textarea class=\"form-control\" rows=\"7\" name=\"message\" id=\"message\" required>Dear, ". ucwords($Row['fname']) ." ". ucwords($Row['lname']) .", We have received and REJECTED your application for ". ucwords($this->jobDetail($Row['job_ID'], "tittle")) .".</textarea>
										</div>
									</div>
									<div class=\"form-group\">
										<hr>
									</div>
									<input type=\"hidden\" id=\"x\" name=\"x\" class=\"form-control\" value=\"REJECTED\" required readonly>
									<input type=\"hidden\" id=\"y\" class=\"form-control\" name=\"y\" value=\"". $Row['job_ID'] ."\" required readonly>
									<div class=\"form-group\" align=\"center\">
										<button type=\"submit\" name=\"mail\" id=\"mail\" class=\"btn btn-common\">SEND MAIL</button>
									</div>
								</form>
							</div>
							<div class=\"modal-footer\">
								<button type=\"button\" class=\"btn btn-border\" data-dismiss=\"modal\">Close</button>
							</div>
						</div>
					</div>
				</div>";
			}
			return $applications;
		}
	}

	/*public function modals($value) {

		$variable = []; // array of job id's from appy_tb where employee_is is current session
		foreach ($variable as $key => $value) {
			$accept = "#accept". $value;
			$reject = "#reject". $value;
		}

	}*/

	public function interview($Query, $to, $subject, $message) {
		
		if ($this->_db->query($Query) === TRUE) {
			$headers = "From: " . SITEBOOKINGS . "\r\n" . "Reply-To: " . SITEBOOKINGS . "\r\n" . "X-Mailer: PHP/" . $phpversion;
			mail($to, $subject, $message, $headers);
    		$action = "Success";
    	} else {
    		$action = "Failed";
    	}

		return "".SITEURL."/applications.php?action=" . $action;

	}

}
?>