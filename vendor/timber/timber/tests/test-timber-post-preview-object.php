<?php

	class TestTimberPostPreviewObject extends Timber_UnitTestCase {

		function testPreviewTags() {
			$post_id = $this->factory->post->create(array('post_excerpt' => 'It turned out that just about anyone in authority — cops, judges, city leaders — was in on the game.'));
			$post = new TimberPost($post_id);
			$template = '{{post.preview.length(3).read_more(false).strip(false)}}';
			$str = Timber::compile_string($template, array('post' => $post));
			$this->assertNotContains('</p>', $str);
		}

		function testPostPreviewObjectWithLength() {
			$pid = $this->factory->post->create( array('post_content' => 'Lauren is a duck she a big ole duck!', 'post_excerpt' => '') );
			$template = '{{ post.preview.length(4) }}';
			$post = new TimberPost($pid);
			$str = Timber::compile_string($template, array('post' => $post));
			$this->assertEquals('Lauren is a duck&hellip; <a href="http://example.org/?p='.$pid.'" class="read-more">Read More</a>', $str);
		}

		function testPostPreviewObjectWithForcedLength() {
			$pid = $this->factory->post->create( array('post_content' => 'Great Gatsby', 'post_excerpt' => 'In my younger and more vulnerable years my father gave me some advice that I’ve been turning over in my mind ever since.') );
			$template = '{{ post.preview.force.length(3) }}';
			$post = new TimberPost($pid);
			$str = Timber::compile_string($template, array('post' => $post));
			$this->assertEquals('In my younger&hellip; <a href="http://example.org/?p='.$pid.'" class="read-more">Read More</a>', $str);
		}

		function testPostPreviewObject() {
			$pid = $this->factory->post->create( array('post_content' => 'Great Gatsby', 'post_excerpt' => 'In my younger and more vulnerable years my father gave me some advice that I’ve been <a href="http://google.com">turning over</a> in my mind ever since.') );
			$template = '{{ post.preview }}';
			$post = new TimberPost($pid);
			$str = Timber::compile_string($template, array('post' => $post));
			$this->assertEquals('In my younger and more vulnerable years my father gave me some advice that I’ve been turning over in my mind ever since. <a href="http://example.org/?p='.$pid.'" class="read-more">Read More</a>', $str);
		}

		function testPostPreviewObjectStrip() {
			$pid = $this->factory->post->create( array('post_content' => 'Great Gatsby', 'post_excerpt' => 'In my younger and more vulnerable years my father gave me some advice that I’ve been <a href="http://google.com">turning over</a> in my mind ever since.') );
			$template = '{{ post.preview.strip(false) }}';
			$post = new TimberPost($pid);
			$str = Timber::compile_string($template, array('post' => $post));
			$this->assertEquals('In my younger and more vulnerable years my father gave me some advice that I’ve been <a href="http://google.com">turning over</a> in my mind ever since. <a href="http://example.org/?p='.$pid.'" class="read-more">Read More</a>', $str);
		}

		function testPostPreviewObjectWithReadMore() {
			$pid = $this->factory->post->create( array('post_content' => 'Great Gatsby', 'post_excerpt' => 'In my younger and more vulnerable years my father gave me some advice that I’ve been turning over in my mind ever since.') );
			$template = '{{ post.preview.read_more("Keep Reading") }}';
			$post = new TimberPost($pid);
			$str = Timber::compile_string($template, array('post' => $post));
			$this->assertEquals('In my younger and more vulnerable years my father gave me some advice that I’ve been turning over in my mind ever since. <a href="http://example.org/?p='.$pid.'" class="read-more">Keep Reading</a>', $str);
		}

		function testPostPreviewObjectWithEverything() {
			$pid = $this->factory->post->create( array('post_content' => 'Great Gatsby', 'post_excerpt' => 'In my younger and more vulnerable years my father gave me some advice that I’ve been turning over in my mind ever since.') );
			$template = '{{ post.preview.length(6).force.end("-->").read_more("Keep Reading") }}';
			$post = new TimberPost($pid);
			$str = Timber::compile_string($template, array('post' => $post));
			$this->assertEquals('In my younger and more vulnerable--> <a href="http://example.org/?p='.$pid.'" class="read-more">Keep Reading</a>', $str);
		}

		function testPreviewWithMoreTagAndForcedLength() {
			$pid = $this->factory->post->create( array('post_content' => 'Lauren is a duck<!-- more--> Lauren is not a duck', 'post_excerpt' => '') );
			$post = new TimberPost( $pid );

			$this->assertEquals('Lauren is a duck <a href="'.$post->link().'" class="read-more">Read More</a>', $post->preview());
		}

		function testPreviewWithCustomMoreTag() {
			$pid = $this->factory->post->create( array('post_content' => 'Eric is a polar bear <!-- more But what is Elaina? --> Lauren is not a duck', 'post_excerpt' => '') );
			$post = new TimberPost( $pid );
			$this->assertEquals('Eric is a polar bear <a href="'.$post->link().'" class="read-more">But what is Elaina?</a>', $post->preview());
		}

		function testPreviewWithSpaceInMoreTag() {
			$pid = $this->factory->post->create( array('post_content' => 'Lauren is a duck, but a great duck let me tell you why <!--more--> Lauren is not a duck', 'post_excerpt' => '') );
			$post = new TimberPost( $pid );
			$template = '{{post.preview.length(3).force}}';
			$str = Timber::compile_string($template, array('post' => $post));
			$this->assertEquals('Lauren is a&hellip; <a href="'.$post->link().'" class="read-more">Read More</a>', $str);
		}


	}