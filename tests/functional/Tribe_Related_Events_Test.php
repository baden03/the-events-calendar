<?php

/**
 * Class Tribe_Related_Events_Test
 *
 * @group pro
 * @group related
 */
class Tribe_Related_Events_Test extends Tribe__Events__Pro__WP_UnitTestCase {
	public function test_enabled_by_default() {
		$ecp = Tribe__Events__Pro__Main::instance();
		$this->assertTrue($ecp->show_related_events());
	}

	public function test_disable_related_events() {
		$core = Tribe__Settings_Manager::instance();
		$ecp = Tribe__Events__Pro__Main::instance();
		$core->set_option('hideRelatedEvents', TRUE);

		$this->assertFalse($ecp->show_related_events());
	}
}
