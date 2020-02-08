<?php /* Q24028866 */
$testData = array(
	array('id' => 2, 'date' => '05/13/2014', 'content' => 'some contents 2', 'act' => 'act1 act2 act3'),
	array('id' => 2, 'date' => '05/28/2014', 'content' => 'some contents 2',  'act' => 'act1 act2 act3'),
	array('id' => 7, 'date' => '06/04/2014', 'content' => 'some contents 7',  'act' => 'act1 act2 act3'),
	array('id' => 8, 'date' => '06/08/2014', 'content' => 'some contents 8',  'act' => 'act1 act2 act3'),
	array('id' => 8, 'date' => '06/09/2014', 'content' => 'some contents 8',  'act' => 'act1 act2 act3')
);
?>
<!DOCTYPE html>
<html>

<head>
</head>

<body>
	<table border='1'>
		<thead>
			<th>Date</th>
			<th>Content</th>
			<th>Act</th>
		</thead>
		<?php
		// use 'read ahead' so there is always a 'previous' record to compare against...
		$iterContents = new \ArrayIterator($testData);
		$curEntry = $iterContents->current();

		while ($iterContents->valid()) { // there are entries to process

			$curId = $curEntry['id'];
			var_dump($curId);
			echo '1';

			// buffer the group to find out how many entries it has...
			$buffer = array();
			$buffer[] = $curEntry;
			var_dump($buffer);
			echo '2';

			$iterContents->next(); // next entry - may be same or different id...
			$curEntry = $iterContents->current();
			var_dump($curEntry);
			echo '3';

			while ($iterContents->valid() && $curEntry['id'] == $curId) {  // process the group...
				$buffer[] = $curEntry; // store all records for a group in the buffer

				$iterContents->next(); // next entry - may be same or different id...
				$curEntry = $iterContents->current();
			}

			// display the current group in the buffer...
			echo '<tr>';
			echo '<td>', $buffer[0]['date'], '</td>';

			$rowspan = count($buffer) > 1 ? ' rowspan="' . count($buffer) . '"' : '';
			echo '<td', $rowspan, '>', $buffer[0]['content'], '</td>', '<td', $rowspan, '>', $buffer[0]['act'], '</td>';
			echo '</tr>';
			for ($i = 1; $i < count($buffer); $i++) {
				echo '<tr><td>', $buffer[$i]['date'], '</td>';
				echo '</tr>';
			}
		} ?>
	</table>
</body>

</html>
