<?php

class Component {
	public function quick_access_menu(array $link_pairs) {
		$result = "";
		foreach ($link_pairs as $key => $value) {
			$result .= "<li><a class='block py-1' href='$value'>$key</a></li>";
		}
		return $result;
	}

	public function image(string $url, string $classes=null) {
		return "<img class='w-full md:w-4/5 mx-auto my-2 aspect-video object-cover rounded-md shadow-md shadow-slate-900/60 cursor-pointer $classes' src='$url'>";
	}

	public function boxed_list(string $title, array $link_pairs) {
		$result = <<< ___EOF
			<div class="mx-4 mt-4 px-4 py-2 w-fit border-2 rounded-md">
				<h3 class="text-center font-bold">$title</h3>
				<hr class="my-2 border-gray">
				<ol class="list-disc list-inside">
		___EOF;
		foreach ($link_pairs as $key => $value) {
			$result .= "<li><a href='$value'>$key</a></li>";
		}
		$result .= "</ol></div>";
		return $result;
	}
}
?>
