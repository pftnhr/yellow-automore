<?php
// Automore extension, https://github.com/pftnhr/yellow-automore

class YellowAutomore {
    const VERSION = "0.8.15";
    public $yellow;            //access to API

    // Handle initialisation
    public function onLoad($yellow) {
        $this->yellow = $yellow;
        $this->yellow->system->setDefault("automoreLength", "250");
    }

    // Handle page content in HTML format
    public function onParseContentHtml($page, $text) {
        $output = null;
        if ($this->yellow->page->get("layout") === "blog-start") {
            $length = $this->yellow->system->get("automoreLength");

            if (strlenu($text) >= $length) {
                $text = substru(strip_tags($text), 0, $length) . "...\n";
                $text .= "<p><small><a href=\"".$page->getLocation(true)."\">".$this->yellow->language->getTextHtml("blogMore")."</small></a></p>";
            }

            $output = $text;
        }
        return $output;
    }
}
