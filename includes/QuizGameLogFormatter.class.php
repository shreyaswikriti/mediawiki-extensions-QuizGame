<?php
/**
 * Logging formatter for QuizGame's log entries.
 *
 * @file
 * @date 6 July 2013
 */
class QuizGameLogFormatter extends LogFormatter {
	/**
	 * Gets the log action, including username.
	 *
	 * This is a copy of LogFormatter::getActionText() with one "escaped"
	 * swapped to parse; no other changes here!
	 *
	 * @return string HTML
	 */
	public function getActionText() {
		if ( $this->canView( LogPage::DELETED_ACTION ) ) {
			$element = $this->getActionMessage();
			if ( $element instanceof Message ) {
				$element = $this->plaintext ? $element->text() : $element->parse(); // <-- here's the change!
			}
			if ( $this->entry->isDeleted( LogPage::DELETED_ACTION ) ) {
				$element = $this->styleRestricedElement( $element );
			}
		} else {
			$performer = $this->getPerformerElement() . $this->msg( 'word-separator' )->text();
			$element = $performer . $this->getRestrictedElement( 'rev-deleted-event' );
		}

		return $element;
	}
}
