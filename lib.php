<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Library of interface functions and constants for module newsdisplay
 *
 * All the core Moodle functions, neeeded to allow the module to work
 * integrated in Moodle should be placed here.
 * All the newsdisplay specific functions, needed to implement all the module
 * logic, should go to locallib.php. This will help to save some memory when
 * Moodle is performing actions across all modules.
 *
 * @package    mod_newsdisplay
 * @copyright  2011 Your Name
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/** example constant */
//define('NEWSDISPLAY_ULTIMATE_ANSWER', 42);

////////////////////////////////////////////////////////////////////////////////
// Moodle core API                                                            //
////////////////////////////////////////////////////////////////////////////////

/**
 * Returns the information on whether the module supports a feature
 *
 * @see plugin_supports() in lib/moodlelib.php
 * @param string $feature FEATURE_xx constant for requested feature
 * @return mixed true if the feature is supported, null if unknown
 */
function newsdisplay_supports($feature) {
    switch($feature) {
        case FEATURE_MOD_INTRO:         return true;
        case FEATURE_SHOW_DESCRIPTION:  return true;
        case FEATURE_BACKUP_MOODLE2:          return true;
        case FEATURE_NO_VIEW_LINK:            return true;

        default:                        return null;
    }
}

/**
 * Saves a new instance of the newsdisplay into the database
 *
 * Given an object containing all the necessary data,
 * (defined by the form in mod_form.php) this function
 * will create a new instance and return the id number
 * of the new instance.
 *
 * @param object $newsdisplay An object from the form in mod_form.php
 * @param mod_newsdisplay_mod_form $mform
 * @return int The id of the newly inserted newsdisplay record
 */
function newsdisplay_add_instance(stdClass $newsdisplay, mod_newsdisplay_mod_form $mform = null) {
    global $DB;

    $newsdisplay->timecreated = time();

    # You may have to add extra stuff in here #

    return $DB->insert_record('newsdisplay', $newsdisplay);
}

/**
 * Updates an instance of the newsdisplay in the database
 *
 * Given an object containing all the necessary data,
 * (defined by the form in mod_form.php) this function
 * will update an existing instance with new data.
 *
 * @param object $newsdisplay An object from the form in mod_form.php
 * @param mod_newsdisplay_mod_form $mform
 * @return boolean Success/Fail
 */
function newsdisplay_update_instance(stdClass $newsdisplay, mod_newsdisplay_mod_form $mform = null) {
    global $DB;

    $newsdisplay->timemodified = time();
    $newsdisplay->id = $newsdisplay->instance;

    # You may have to add extra stuff in here #

    return $DB->update_record('newsdisplay', $newsdisplay);
}

/**
 * Removes an instance of the newsdisplay from the database
 *
 * Given an ID of an instance of this module,
 * this function will permanently delete the instance
 * and any data that depends on it.
 *
 * @param int $id Id of the module instance
 * @return boolean Success/Failure
 */
function newsdisplay_delete_instance($id) {
    global $DB;

    if (! $newsdisplay = $DB->get_record('newsdisplay', array('id' => $id))) {
        return false;
    }

    # Delete any dependent records here #

    $DB->delete_records('newsdisplay', array('id' => $newsdisplay->id));

    return true;
}

/**
 * Returns a small object with summary information about what a
 * user has done with a given particular instance of this module
 * Used for user activity reports.
 * $return->time = the time they did it
 * $return->info = a short text description
 *
 * @return stdClass|null
 */
function newsdisplay_user_outline($course, $user, $mod, $newsdisplay) {

    $return = new stdClass();
    $return->time = 0;
    $return->info = '';
    return $return;
}

/**
 * Prints a detailed representation of what a user has done with
 * a given particular instance of this module, for user activity reports.
 *
 * @param stdClass $course the current course record
 * @param stdClass $user the record of the user we are generating report for
 * @param cm_info $mod course module info
 * @param stdClass $newsdisplay the module instance record
 * @return void, is supposed to echp directly
 */
function newsdisplay_user_complete($course, $user, $mod, $newsdisplay) {
}

/**
 * Given a course and a time, this module should find recent activity
 * that has occurred in newsdisplay activities and print it out.
 * Return true if there was output, or false is there was none.
 *
 * @return boolean
 */
function newsdisplay_print_recent_activity($course, $viewfullnames, $timestart) {
    return false;  //  True if anything was printed, otherwise false
}

/**
 * Prepares the recent activity data
 *
 * This callback function is supposed to populate the passed array with
 * custom activity records. These records are then rendered into HTML via
 * {@link newsdisplay_print_recent_mod_activity()}.
 *
 * @param array $activities sequentially indexed array of objects with the 'cmid' property
 * @param int $index the index in the $activities to use for the next record
 * @param int $timestart append activity since this time
 * @param int $courseid the id of the course we produce the report for
 * @param int $cmid course module id
 * @param int $userid check for a particular user's activity only, defaults to 0 (all users)
 * @param int $groupid check for a particular group's activity only, defaults to 0 (all groups)
 * @return void adds items into $activities and increases $index
 */
function newsdisplay_get_recent_mod_activity(&$activities, &$index, $timestart, $courseid, $cmid, $userid=0, $groupid=0) {
}

/**
 * Prints single activity item prepared by {@see newsdisplay_get_recent_mod_activity()}

 * @return void
 */
function newsdisplay_print_recent_mod_activity($activity, $courseid, $detail, $modnames, $viewfullnames) {
}

/**
 * Function to be run periodically according to the moodle cron
 * This function searches for things that need to be done, such
 * as sending out mail, toggling flags etc ...
 *
 * @return boolean
 * @todo Finish documenting this function
 **/
function newsdisplay_cron () {
    return true;
}

/**
 * Returns all other caps used in the module
 *
 * @example return array('moodle/site:accessallgroups');
 * @return array
 */
function newsdisplay_get_extra_capabilities() {
    return array();
}

/**
 * gets the latest forum post using print_noticeboard
 * structure of cm_info_view copied from forum_cm_info_view
 * @param cm_info $cm Course-module object
 */
function newsdisplay_cm_info_view(cm_info $cm) {
    global $CFG;
    global $DB;
    
    if ($newsdisplay = $DB->get_record('newsdisplay', array('id'=>$cm->instance), 'id, name, intro, introformat')) {
        if (empty($newsdisplay->name)) {
            // news display name missing, fix it
            $newsdisplay->name = "newsdisplay{$newsdisplay->id}";
            $DB->set_field('newsdisplay', 'name', $newsdisplay->name, array('id'=>$newsdisplay->id));
        }
        $info = new cached_cm_info();
        $id = required_param('id', PARAM_INT); // course id from URL parameter
        $course = $DB->get_record('course', array('id' => $id), '*', MUST_EXIST);
        // no filtering here because this info is cached and filtered later
        //$info->content = format_module_intro('news', $news, $coursemodule->id, false);
        //$info->content = format_module_intro('news', $news, $coursemodule->id, false)."++FOO++";//get_content();
        //$info->content = format_module_intro('news', $news, $coursemodule->id, false).print_noticeboard($course);
        $info->content = print_newsdisplay($course);
        //$info->content = "+FOO+";
        //$info->content = get_content();
        //$info->name  = $newsdisplay->name;
        $info->name  = $newsdisplay->name."+FOOBAR+";
        //$info->name  = get_news_content();
        //$cm->set_after_link($info);
        $cm->set_content($info->content);
        return $info;
            } else {
        return null;
 }

}

/**
* Outputs the latest news item.
* @global stdClass $OUTPUT Output renderer instance.
* @param stdClass $course The course to use.
* @copyright  &copy; Granite State College, modified from Noticeboard course format &copy; 2014-onwards G J Barnard in respect to modifications of standard topics format.
* @author     G J Barnard - gjbarnard at gmail dot com, {@link http://about.me/gjbarnard} and
*                           {@link http://moodle.org/user/profile.php?id=442195}
*/
function print_newsdisplay($course) {
	global $OUTPUT;
	global $CFG;
	if ($forum = forum_get_course_forum($course->id, 'news')) {
	    $cm = get_coursemodule_from_instance('forum', $forum->id);
	    $context = context_module::instance($cm->id);
	
	    //echo $this->output->heading(get_string('latestmessage','format_noticebd'), 3, 'sectionname');
	    //echo '<div class="subscribelink">', forum_get_subscribe_link($forum, $context), '</div>';
	    return newsdisplay_print_latest_discussions($course, $forum, 1, 'plain', '', -1, -1, -1, 100, $cm);
	
	} else {
	    return 'Could not find or create a news forum here';
	}
}

/**
 * Simplified version of forum_print_latest_discussions Prints the discussion view screen for a forum.
 *
 * @global object
 * @global object
 * @param object $course The current course object.
 * @param object $forum Forum to be printed.
 * @param int $maxdiscussions .
 * @param string $displayformat The display format to use (optional).
 * @param string $sort Sort arguments for database query (optional).
 * @param int $groupmode Group mode of the forum (optional).
 * @param void $unused (originally current group)
 * @param int $page Page mode, page to display (optional).
 * @param int $perpage The maximum number of discussions per page(optional)
 *
 */
function newsdisplay_print_latest_discussions($course, $forum, $maxdiscussions=-1, $displayformat='plain', $sort='',
                                        $currentgroup=-1, $groupmode=-1, $page=-1, $perpage=100, $cm=NULL) {
    global $CFG, $USER, $OUTPUT;

    if (!$cm) {
        if (!$cm = get_coursemodule_from_instance('forum', $forum->id, $forum->course)) {
            print_error('invalidcoursemodule');
        }
    }
    $context = context_module::instance($cm->id);

    if (empty($sort)) {
        $sort = "d.timemodified DESC";
    }

    $olddiscussionlink = false;

 // Sort out some defaults
    if ($perpage <= 0) {
        $perpage = 0;
        $page    = -1;
    }

    if ($maxdiscussions == 0) {
        // all discussions - backwards compatibility
        $page    = -1;
        $perpage = 0;
        if ($displayformat == 'plain') {
            $displayformat = 'header';  // Abbreviate display by default
        }

    } else if ($maxdiscussions > 0) {
        $page    = -1;
        $perpage = $maxdiscussions;
    }

    $fullpost = false;
    if ($displayformat == 'plain') {
        $fullpost = true;
    }


// Decide if current user is allowed to see ALL the current discussions or not

// First check the group stuff
    if ($currentgroup == -1 or $groupmode == -1) {
        $groupmode    = groups_get_activity_groupmode($cm, $course);
        $currentgroup = groups_get_activity_group($cm);
    }

    $groups = array(); //cache

// If the user can post discussions, then this is a good place to put the
// button for it. We do not show the button if we are showing site news
// and the current user is a guest.

    $canstart = forum_user_can_post_discussion($forum, $currentgroup, $groupmode, $cm, $context);
    if (!$canstart and $forum->type !== 'news') {
        if (isguestuser() or !isloggedin()) {
            $canstart = true;
        }
        if (!is_enrolled($context) and !is_viewing($context)) {
            // allow guests and not-logged-in to see the button - they are prompted to log in after clicking the link
            // normal users with temporary guest access see this button too, they are asked to enrol instead
            // do not show the button to users with suspended enrolments here
            $canstart = enrol_selfenrol_available($course->id);
        }
    }

    if ($canstart) {
        echo '<div class="singlebutton forumaddnew">';
        echo "<form id=\"newdiscussionform\" method=\"get\" action=\"$CFG->wwwroot/mod/forum/post.php\">";
        echo '<div>';
        echo "<input type=\"hidden\" name=\"forum\" value=\"$forum->id\" />";
        switch ($forum->type) {
            case 'news':
            case 'blog':
                $buttonadd = get_string('addanewtopic', 'forum');
                break;
            case 'qanda':
                $buttonadd = get_string('addanewquestion', 'forum');
                break;
            default:
                $buttonadd = get_string('addanewdiscussion', 'forum');
                break;
        }
        echo '<input type="submit" value="'.$buttonadd.'" />';
        echo '</div>';
        echo '</form>';
        echo "</div>\n";

    } else if (isguestuser() or !isloggedin() or $forum->type == 'news' or
        $forum->type == 'qanda' and !has_capability('mod/forum:addquestion', $context) or
        $forum->type != 'qanda' and !has_capability('mod/forum:startdiscussion', $context)) {
        // no button and no info

    } else if ($groupmode and !has_capability('moodle/site:accessallgroups', $context)) {
        // inform users why they can not post new discussion
        if (!$currentgroup) {
            echo $OUTPUT->notification(get_string('cannotadddiscussionall', 'forum'));
        } else if (!groups_is_member($currentgroup)) {
            echo $OUTPUT->notification(get_string('cannotadddiscussion', 'forum'));
        }
    }

// Get all the recent discussions we're allowed to see

    $getuserlastmodified = ($displayformat == 'header');

    if (! $discussions = forum_get_discussions($cm, $sort, $fullpost, null, $maxdiscussions, $getuserlastmodified, $page, $perpage) ) {
        echo '<div class="forumnodiscuss">';
        if ($forum->type == 'news') {
            echo '('.get_string('nonews', 'forum').')';
        } else if ($forum->type == 'qanda') {
            echo '('.get_string('noquestions','forum').')';
        } else {
            echo '('.get_string('nodiscussions', 'forum').')';
        }
        echo "</div>\n";
        return;
    }

// If we want paging
    if ($page != -1) {
        ///Get the number of discussions found
        $numdiscussions = forum_get_discussions_count($cm);

        ///Show the paging bar
        echo $OUTPUT->paging_bar($numdiscussions, $page, $perpage, "view.php?f=$forum->id");
        if ($numdiscussions > 1000) {
            // saves some memory on sites with very large forums
            $replies = forum_count_discussion_replies($forum->id, $sort, $maxdiscussions, $page, $perpage);
        } else {
            $replies = forum_count_discussion_replies($forum->id);
        }

    } else {
        $replies = forum_count_discussion_replies($forum->id);

        if ($maxdiscussions > 0 and $maxdiscussions <= count($discussions)) {
            $olddiscussionlink = true;
        }
    }

    $canviewparticipants = has_capability('moodle/course:viewparticipants',$context);

    $strdatestring = get_string('strftimerecentfull');

    // Check if the forum is tracked.
    if ($cantrack = forum_tp_can_track_forums($forum)) {
        $forumtracked = forum_tp_is_tracked($forum);
    } else {
        $forumtracked = false;
    }

    if ($forumtracked) {
        $unreads = forum_get_discussions_unread($cm);
    } else {
        $unreads = array();
    }

    if ($displayformat == 'header') {
        echo '<table cellspacing="0" class="forumheaderlist">';
        echo '<thead>';
        echo '<tr>';
        echo '<th class="header topic" scope="col">'.get_string('discussion', 'forum').'</th>';
        echo '<th class="header author" colspan="2" scope="col">'.get_string('startedby', 'forum').'</th>';
        if ($groupmode > 0) {
            echo '<th class="header group" scope="col">'.get_string('group').'</th>';
        }
        if (has_capability('mod/forum:viewdiscussion', $context)) {
            echo '<th class="header replies" scope="col">'.get_string('replies', 'forum').'</th>';
            // If the forum can be tracked, display the unread column.
            if ($cantrack) {
                echo '<th class="header replies" scope="col">'.get_string('unread', 'forum');
                if ($forumtracked) {
                    echo '<a title="'.get_string('markallread', 'forum').
                         '" href="'.$CFG->wwwroot.'/mod/forum/markposts.php?f='.
                         $forum->id.'&amp;mark=read&amp;returnpage=view.php">'.
                         '<img src="'.$OUTPUT->pix_url('t/markasread') . '" class="iconsmall" alt="'.get_string('markallread', 'forum').'" /></a>';
                }
                echo '</th>';
            }
        }
        echo '<th class="header lastpost" scope="col">'.get_string('lastpost', 'forum').'</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
    }

    foreach ($discussions as $discussion) {
        if ($forum->type == 'qanda' && !has_capability('mod/forum:viewqandawithoutposting', $context) &&
            !forum_user_has_posted($forum->id, $discussion->discussion, $USER->id)) {
            $canviewparticipants = false;
        }

        if (!empty($replies[$discussion->discussion])) {
            $discussion->replies = $replies[$discussion->discussion]->replies;
            $discussion->lastpostid = $replies[$discussion->discussion]->lastpostid;
        } else {
            $discussion->replies = 0;
        }

        // SPECIAL CASE: The front page can display a news item post to non-logged in users.
        // All posts are read in this case.
        if (!$forumtracked) {
            $discussion->unread = '-';
        } else if (empty($USER)) {
            $discussion->unread = 0;
        } else {
            if (empty($unreads[$discussion->discussion])) {
                $discussion->unread = 0;
            } else {
                $discussion->unread = $unreads[$discussion->discussion];
            }
        }

        if (isloggedin()) {
            $ownpost = ($discussion->userid == $USER->id);
        } else {
            $ownpost=false;
        }
        // Use discussion name instead of subject of first post
        $discussion->subject = $discussion->name;

        switch ($displayformat) {
            case 'header':
                if ($groupmode > 0) {
                    if (isset($groups[$discussion->groupid])) {
                        $group = $groups[$discussion->groupid];
                    } else {
                        $group = $groups[$discussion->groupid] = groups_get_group($discussion->groupid);
                    }
                } else {
                    $group = -1;
                }
                forum_print_discussion_header($discussion, $forum, $group, $strdatestring, $cantrack, $forumtracked,
                    $canviewparticipants, $context);
            break;
            default:
                $link = false;

                if ($discussion->replies) {
                    $link = true;
                } else {
                    $modcontext = context_module::instance($cm->id);
                    $link = forum_user_can_see_discussion($forum, $discussion, $modcontext, $USER);
                }

                $discussion->forum = $forum->id;

                forum_print_post($discussion, $discussion, $forum, $cm, $course, $ownpost, 0, $link, false,
                        '', null, true, $forumtracked);
            break;
        }
    }

    if ($displayformat == "header") {
        echo '</tbody>';
        echo '</table>';
    }

    if ($olddiscussionlink) {
        if ($forum->type == 'news') {
            $strolder = get_string('oldertopics', 'forum');
        } else {
            $strolder = get_string('olderdiscussions', 'forum');
        }
        echo '<div class="forumolddiscuss">';
        echo '<a href="'.$CFG->wwwroot.'/mod/forum/view.php?f='.$forum->id.'&amp;showall=1">';
        echo $strolder.'</a> ...</div>';
    }

    if ($page != -1) { ///Show the paging bar
        echo $OUTPUT->paging_bar($numdiscussions, $page, $perpage, "view.php?f=$forum->id");
    }
}





/**
 * This file contains an adaptation of the news item block class, based upon block_base.
 *
 * @copyright  2014 Granite State College, adapted from block_news_items c. 1999 onwards Martin Dougiamas (http://dougiamas.com)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

function get_news_content($course) {
global $CFG, $USER;


if ($course->newsitems) {   // Create a nice listing of recent postings

    require_once($CFG->dirroot.'/mod/forum/lib.php');   // We'll need this

    $text = '';

    if (!$forum = forum_get_course_forum($course->id, 'news')) {
	return '';
    }

    $modinfo = get_fast_modinfo($course);
    if (empty($modinfo->instances['forum'][$forum->id])) {
	return '';
    }
    $cm = $modinfo->instances['forum'][$forum->id];

    if (!$cm->uservisible) {
	return '';
    }

    $context = context_module::instance($cm->id);

/// User must have perms to view discussions in that forum
    if (!has_capability('mod/forum:viewdiscussion', $context)) {
	return '';
    }

/// First work out whether we can post to this group and if so, include a link
    $groupmode    = groups_get_activity_groupmode($cm);
    $currentgroup = groups_get_activity_group($cm, true);


    if (forum_user_can_post_discussion($forum, $currentgroup, $groupmode, $cm, $context)) {
	$text .= '<div class="newlink"><a href="'.$CFG->wwwroot.'/mod/forum/post.php?forum='.$forum->id.'">'.
		  get_string('addanewtopic', 'forum').'</a>...</div>';
    }

/// Get all the recent discussions we're allowed to see

    if (! $discussions = forum_get_discussions($cm, 'p.modified DESC', false,
					       $currentgroup, $course->newsitems) ) {
	$text .= '('.get_string('nonews', 'forum').')';
	$this->content->text = $text;
	return $this->content;
    }

/// Actually create the listing now

    $strftimerecent = get_string('strftimerecent');
    $strmore = get_string('more', 'forum');

/// Accessibility: markup as a list.
    $text .= "\n<ul class='unlist'>\n";
    foreach ($discussions as $discussion) {

	$discussion->subject = $discussion->name;

	$discussion->subject = format_string($discussion->subject, true, $forum->course);

	$text .= '<li class="post">'.
		 '<div class="head clearfix">'.
		 '<div class="date">'.userdate($discussion->modified, $strftimerecent).'</div>'.
		 '<div class="name">'.fullname($discussion).'</div></div>'.
		 '<div class="info"><a href="'.$CFG->wwwroot.'/mod/forum/discuss.php?d='.$discussion->discussion.'">'.$discussion->subject.'</a></div>'.
		 "</li>\n";
    }
    $text .= "</ul>\n";

    $this->content->text = $text;

    $this->content->footer = '<a href="'.$CFG->wwwroot.'/mod/forum/view.php?f='.$forum->id.'">'.
			      get_string('oldertopics', 'forum').'</a> ...';

/// If RSS is activated at site and forum level and this forum has rss defined, show link
    if (isset($CFG->enablerssfeeds) && isset($CFG->forum_enablerssfeeds) &&
	$CFG->enablerssfeeds && $CFG->forum_enablerssfeeds && $forum->rsstype && $forum->rssarticles) {
	require_once($CFG->dirroot.'/lib/rsslib.php');   // We'll need this
	if ($forum->rsstype == 1) {
	    $tooltiptext = get_string('rsssubscriberssdiscussions','forum');
	} else {
	    $tooltiptext = get_string('rsssubscriberssposts','forum');
	}
	if (!isloggedin()) {
	    $userid = $CFG->siteguest;
	} else {
	    $userid = $USER->id;
	}

	$this->content->footer .= '<br />'.rss_get_link($context->id, $userid, 'mod_forum', $forum->id, $tooltiptext);
    }

}

return $this->content;
}


////////////////////////////////////////////////////////////////////////////////
// Gradebook API                                                              //
////////////////////////////////////////////////////////////////////////////////

/**
 * Is a given scale used by the instance of newsdisplay?
 *
 * This function returns if a scale is being used by one newsdisplay
 * if it has support for grading and scales. Commented code should be
 * modified if necessary. See forum, glossary or journal modules
 * as reference.
 *
 * @param int $newsdisplayid ID of an instance of this module
 * @return bool true if the scale is used by the given newsdisplay instance
 */
function newsdisplay_scale_used($newsdisplayid, $scaleid) {
    global $DB;

    /** @example */
    if ($scaleid and $DB->record_exists('newsdisplay', array('id' => $newsdisplayid, 'grade' => -$scaleid))) {
        return true;
    } else {
        return false;
    }
}

/**
 * Checks if scale is being used by any instance of newsdisplay.
 *
 * This is used to find out if scale used anywhere.
 *
 * @param $scaleid int
 * @return boolean true if the scale is used by any newsdisplay instance
 */
function newsdisplay_scale_used_anywhere($scaleid) {
    global $DB;

    /** @example */
    if ($scaleid and $DB->record_exists('newsdisplay', array('grade' => -$scaleid))) {
        return true;
    } else {
        return false;
    }
}

/**
 * Creates or updates grade item for the give newsdisplay instance
 *
 * Needed by grade_update_mod_grades() in lib/gradelib.php
 *
 * @param stdClass $newsdisplay instance object with extra cmidnumber and modname property
 * @param mixed optional array/object of grade(s); 'reset' means reset grades in gradebook
 * @return void
 */
function newsdisplay_grade_item_update(stdClass $newsdisplay, $grades=null) {
    global $CFG;
    require_once($CFG->libdir.'/gradelib.php');

    /** @example */
    $item = array();
    $item['itemname'] = clean_param($newsdisplay->name, PARAM_NOTAGS);
    $item['gradetype'] = GRADE_TYPE_VALUE;
    $item['grademax']  = $newsdisplay->grade;
    $item['grademin']  = 0;

    grade_update('mod/newsdisplay', $newsdisplay->course, 'mod', 'newsdisplay', $newsdisplay->id, 0, null, $item);
}

/**
 * Update newsdisplay grades in the gradebook
 *
 * Needed by grade_update_mod_grades() in lib/gradelib.php
 *
 * @param stdClass $newsdisplay instance object with extra cmidnumber and modname property
 * @param int $userid update grade of specific user only, 0 means all participants
 * @return void
 */
function newsdisplay_update_grades(stdClass $newsdisplay, $userid = 0) {
    global $CFG, $DB;
    require_once($CFG->libdir.'/gradelib.php');

    /** @example */
    $grades = array(); // populate array of grade objects indexed by userid

    grade_update('mod/newsdisplay', $newsdisplay->course, 'mod', 'newsdisplay', $newsdisplay->id, 0, $grades);
}

////////////////////////////////////////////////////////////////////////////////
// File API                                                                   //
////////////////////////////////////////////////////////////////////////////////

/**
 * Returns the lists of all browsable file areas within the given module context
 *
 * The file area 'intro' for the activity introduction field is added automatically
 * by {@link file_browser::get_file_info_context_module()}
 *
 * @param stdClass $course
 * @param stdClass $cm
 * @param stdClass $context
 * @return array of [(string)filearea] => (string)description
 */
function newsdisplay_get_file_areas($course, $cm, $context) {
    return array();
}

/**
 * File browsing support for newsdisplay file areas
 *
 * @package mod_newsdisplay
 * @category files
 *
 * @param file_browser $browser
 * @param array $areas
 * @param stdClass $course
 * @param stdClass $cm
 * @param stdClass $context
 * @param string $filearea
 * @param int $itemid
 * @param string $filepath
 * @param string $filename
 * @return file_info instance or null if not found
 */
function newsdisplay_get_file_info($browser, $areas, $course, $cm, $context, $filearea, $itemid, $filepath, $filename) {
    return null;
}

/**
 * Serves the files from the newsdisplay file areas
 *
 * @package mod_newsdisplay
 * @category files
 *
 * @param stdClass $course the course object
 * @param stdClass $cm the course module object
 * @param stdClass $context the newsdisplay's context
 * @param string $filearea the name of the file area
 * @param array $args extra arguments (itemid, path)
 * @param bool $forcedownload whether or not force download
 * @param array $options additional options affecting the file serving
 */
function newsdisplay_pluginfile($course, $cm, $context, $filearea, array $args, $forcedownload, array $options=array()) {
    global $DB, $CFG;

    if ($context->contextlevel != CONTEXT_MODULE) {
        send_file_not_found();
    }

    require_login($course, true, $cm);

    send_file_not_found();
}

////////////////////////////////////////////////////////////////////////////////
// Navigation API                                                             //
////////////////////////////////////////////////////////////////////////////////

/**
 * Extends the global navigation tree by adding newsdisplay nodes if there is a relevant content
 *
 * This can be called by an AJAX request so do not rely on $PAGE as it might not be set up properly.
 *
 * @param navigation_node $navref An object representing the navigation tree node of the newsdisplay module instance
 * @param stdClass $course
 * @param stdClass $module
 * @param cm_info $cm
 */
function newsdisplay_extend_navigation(navigation_node $navref, stdclass $course, stdclass $module, cm_info $cm) {
}

/**
 * Extends the settings navigation with the newsdisplay settings
 *
 * This function is called when the context for the page is a newsdisplay module. This is not called by AJAX
 * so it is safe to rely on the $PAGE.
 *
 * @param settings_navigation $settingsnav {@link settings_navigation}
 * @param navigation_node $newsdisplaynode {@link navigation_node}
 */
function newsdisplay_extend_settings_navigation(settings_navigation $settingsnav, navigation_node $newsdisplaynode=null) {
}
