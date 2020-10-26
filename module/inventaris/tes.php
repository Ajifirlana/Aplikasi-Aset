<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<div class="block-border">
  <div class="block-header">
    <h1>Form-Elements with Validation</h1>
    <span></span> </div>
  <form id="validate-form" class="block-content form" action="" method="post">
    <div class="_100">
      <p>
        <label for="textfield">Textfield</label>
        <input id="textfield" name="textfield" class="required" type="text" value="" />
      </p>
    </div>
    <div class="_100">
      <p>
        <label for="textarea">Textarea</label>
        <textarea id="textarea" name="textarea" class="required" rows="5" cols="40"></textarea>
      </p>
    </div>
    <div class="_100">
      <p>
        <label for="datepicker">Datepicker</label>
        <input id="datepicker" name="datepicker" class="required" type="text" value="" />
      </p>
    </div>
    <div class="_100">
      <p>
        <label for="select">Select</label>
        <select name="select">
          <option>Lorem Ipsum</option>
          <option>Consetetur Sadipscing</option>
          <option>Eirmod Tempor</option>
        </select>
      </p>
    </div>
    <div class="_100">
      <p>
        <label for="file">Upload a file</label>
        <input type="file" />
      </p>
    </div>
    <div class="_50">
      <p> <span class="label">Radio-Buttons</span>
        <label>
          <input type="radio" name="radio" />
          Dolor sit</label>
        <label>
          <input type="radio" name="radio" />
          Et accusam</label>
        <label>
          <input type="radio" name="radio" />
          Justo duo</label>
      </p>
    </div>
    <div class="_50">
      <p> <span class="label">Checkboxes</span>
        <label>
          <input type="checkbox" name="checkbox" />
          Check me</label>
        <label>
          <input type="checkbox" />
          Or me</label>
        <label>
          <input type="checkbox" />
          Lorem ipsum</label>
      </p>
    </div>
    <div class="clear"></div>
    <div class="block-actions">
      <ul class="actions-left">
        <li><a class="button red" id="reset-validate-form" href="javascript:void(0);">Reset</a></li>
      </ul>
      <ul class="actions-right">
        <li>
          <input type="submit" class="button" value="Click here to validate the form!" />
        </li>
      </ul>
    </div>
  </form>
</div>
</body>
</html>