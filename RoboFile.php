<?php
class RoboFile extends \Robo\Tasks
{
 
 	function post()
 	{
 		$title = $this->ask("Post title");
 		$file = strtolower(str_replace([' ',':'], ['-','-'], $title));
 		$date = date('Y-m-d');
 		$this->taskWriteToFile("_posts/$date-$file.markdown")
 			->line('---')
 			->line('layout: post')
 			->line("title: \"$title\"")
 			->line("date: $date 01:03:50")
 			->line("---\n")
 			->run();
 	}

 	function publish()
 	{
 		$this->taskGitStack()
 			->add('-A')
 			->commit('updated')
 			->pull()
 			->push()
 			->run();
 	}
}