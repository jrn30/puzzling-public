<form action="index.php" method="get">

<table>

<tr>

<td valign="top">

<b>Search Dictionary:</b>&nbsp;

</td>

<td>

<input type="hidden" name="section" value="glossarysearch">
<input type="text" class="text" name="search" maxlength="50" value="<?=$search ?>">

</td>

<td>

&nbsp;&nbsp;<input type="submit" class="button" value="Search">

</td>
</tr>

<tr>
<td></td>

<td valign="middle">

<span class="smallbold">Search type:&nbsp;</span>
<span class="small">

<input type="radio" checked name="boolean" value="AND">All words&nbsp;
<input type="radio" name="boolean" value="OR">Any words

</span>
</td>

<td></td>

</tr>
</table>

</form>

<?php if (!empty($search)) {
  echo("<a href=\"index.php?section=glossary\">Back to Main Dictionary</a><br>");
} ?>

</div>