<?php
/* Article Test cases generated on: 2011-07-19 11:16:54 : 1311074214*/
App::import('Model', 'Article');

class ArticleTestCase extends CakeTestCase {
	var $fixtures = array('app.article', 'app.section', 'app.articles_section');

	function startTest() {
		$this->Article =& ClassRegistry::init('Article');
	}

	function endTest() {
		unset($this->Article);
		ClassRegistry::flush();
	}

}
?>