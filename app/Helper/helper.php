<?PHP

// Check it out -- http://laravel-recipes.com/recipes/50/creating-a-helpers-file
// Check it out -- https://laravel-news.com/creating-helpers -- require __DIR__.'/../vendor/autoload.php';

// just added next 3 line
use Illuminate\Http\Request;
use App\Model;
use Illuminate\Support\Facades\Input;

	function checkAdmin(){
		$user_stuff = auth()->user();
		$user_type = $user_stuff->usertype;
		if($user_type==1){
			
		}else{
			die('User Not Admin');
			return redirect()->to('/home');
		}
	}

	function compDates($time){
		date_default_timezone_set('Asia/Manila');
		$start = date_create($time);
		$end = date_create(); // Current time and date
		$diff = date_diff( $start, $end );
		if($diff->y==0){
			if($diff->m==0){
				if($diff->d==0){
					if($diff->h==0){
						if($diff->i==0){
							$msg = "Just now";
						}elseif($diff->i==1){
							$msg = $diff->i." minute ago";
						}else{
							$msg = $diff->i." minutes ago";
						}
					}elseif($diff->h==1){
						$msg = $diff->h. " hour ago";
					}else{
						$msg = $diff->h. " hours ago";
					}
				}elseif($diff->d>7){
					$days = $diff->d;
					$weeks = $days/7;
					$weeks = round($weeks);
					if($weeks==1){
						$msg = "$weeks week ago";
					}else{
						$msg = "$weeks weeks ago";
					}
				}elseif($diff->d==1){
					$msg = $diff->d." day ago";
				}else{
					$msg = $diff->d." days ago";
				}
			}elseif($diff->m==1){
				$msg = $diff->m." month ago";
			}else{
				$msg = $diff->m." months ago";
			}
		}elseif($diff->y==1){
			$msg = $diff->y." year ago";
		}else{
			$msg = $diff->y." years ago";
		}return $msg;
	}

?>