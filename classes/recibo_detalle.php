<?php namespace PHPMaker2020\condominios; ?>
<?php

/**
 * Table class for recibo_detalle
 */
class recibo_detalle extends DbTable
{
	protected $SqlFrom = "";
	protected $SqlSelect = "";
	protected $SqlSelectList = "";
	protected $SqlWhere = "";
	protected $SqlGroupBy = "";
	protected $SqlHaving = "";
	protected $SqlOrderBy = "";
	public $UseSessionForListSql = TRUE;

	// Column CSS classes
	public $LeftColumnClass = "col-sm-2 col-form-label ew-label";
	public $RightColumnClass = "col-sm-10";
	public $OffsetColumnClass = "col-sm-10 offset-sm-2";
	public $TableLeftColumnClass = "w-col-2";

	// Export
	public $ExportDoc;

	// Fields
	public $id_recibo_detalle;
	public $recibo_id;
	public $gastos_id;
	public $cantidad;
	public $precio;
	public $total;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'recibo_detalle';
		$this->TableName = 'recibo_detalle';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`recibo_detalle`";
		$this->Dbid = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
		$this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
		$this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
		$this->ExportWordColumnWidth = NULL; // Cell width (PHPWord only)
		$this->DetailAdd = FALSE; // Allow detail add
		$this->DetailEdit = FALSE; // Allow detail edit
		$this->DetailView = FALSE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 5;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = 0; // User ID Allow
		$this->BasicSearch = new BasicSearch($this->TableVar);

		// id_recibo_detalle
		$this->id_recibo_detalle = new DbField('recibo_detalle', 'recibo_detalle', 'x_id_recibo_detalle', 'id_recibo_detalle', '`id_recibo_detalle`', '`id_recibo_detalle`', 3, 11, -1, FALSE, '`id_recibo_detalle`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id_recibo_detalle->IsAutoIncrement = TRUE; // Autoincrement field
		$this->id_recibo_detalle->IsPrimaryKey = TRUE; // Primary key field
		$this->id_recibo_detalle->Sortable = TRUE; // Allow sort
		$this->id_recibo_detalle->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_recibo_detalle'] = &$this->id_recibo_detalle;

		// recibo_id
		$this->recibo_id = new DbField('recibo_detalle', 'recibo_detalle', 'x_recibo_id', 'recibo_id', '`recibo_id`', '`recibo_id`', 3, 11, -1, FALSE, '`recibo_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->recibo_id->Nullable = FALSE; // NOT NULL field
		$this->recibo_id->Required = TRUE; // Required field
		$this->recibo_id->Sortable = TRUE; // Allow sort
		$this->recibo_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['recibo_id'] = &$this->recibo_id;

		// gastos_id
		$this->gastos_id = new DbField('recibo_detalle', 'recibo_detalle', 'x_gastos_id', 'gastos_id', '`gastos_id`', '`gastos_id`', 3, 11, -1, FALSE, '`gastos_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->gastos_id->Nullable = FALSE; // NOT NULL field
		$this->gastos_id->Required = TRUE; // Required field
		$this->gastos_id->Sortable = TRUE; // Allow sort
		$this->gastos_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['gastos_id'] = &$this->gastos_id;

		// cantidad
		$this->cantidad = new DbField('recibo_detalle', 'recibo_detalle', 'x_cantidad', 'cantidad', '`cantidad`', '`cantidad`', 3, 11, -1, FALSE, '`cantidad`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->cantidad->Nullable = FALSE; // NOT NULL field
		$this->cantidad->Required = TRUE; // Required field
		$this->cantidad->Sortable = TRUE; // Allow sort
		$this->cantidad->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['cantidad'] = &$this->cantidad;

		// precio
		$this->precio = new DbField('recibo_detalle', 'recibo_detalle', 'x_precio', 'precio', '`precio`', '`precio`', 131, 17, -1, FALSE, '`precio`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->precio->Nullable = FALSE; // NOT NULL field
		$this->precio->Required = TRUE; // Required field
		$this->precio->Sortable = TRUE; // Allow sort
		$this->precio->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['precio'] = &$this->precio;

		// total
		$this->total = new DbField('recibo_detalle', 'recibo_detalle', 'x_total', 'total', '`total`', '`total`', 131, 17, -1, FALSE, '`total`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->total->Nullable = FALSE; // NOT NULL field
		$this->total->Required = TRUE; // Required field
		$this->total->Sortable = TRUE; // Allow sort
		$this->total->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['total'] = &$this->total;
	}

	// Field Visibility
	public function getFieldVisibility($fldParm)
	{
		global $Security;
		return $this->$fldParm->Visible; // Returns original value
	}

	// Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
	function setLeftColumnClass($class)
	{
		if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
			$this->LeftColumnClass = $class . " col-form-label ew-label";
			$this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - (int)$match[2]);
			$this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace("col-", "offset-", $class);
			$this->TableLeftColumnClass = preg_replace('/^col-\w+-(\d+)$/', "w-col-$1", $class); // Change to w-col-*
		}
	}

	// Single column sort
	public function updateSort(&$fld)
	{
		if ($this->CurrentOrder == $fld->Name) {
			$sortField = $fld->Expression;
			$lastSort = $fld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$thisSort = $this->CurrentOrderType;
			} else {
				$thisSort = ($lastSort == "ASC") ? "DESC" : "ASC";
			}
			$fld->setSort($thisSort);
			$this->setSessionOrderBy($sortField . " " . $thisSort); // Save to Session
		} else {
			$fld->setSort("");
		}
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`recibo_detalle`";
	}
	public function sqlFrom() // For backward compatibility
	{
		return $this->getSqlFrom();
	}
	public function setSqlFrom($v)
	{
		$this->SqlFrom = $v;
	}
	public function getSqlSelect() // Select
	{
		return ($this->SqlSelect != "") ? $this->SqlSelect : "SELECT * FROM " . $this->getSqlFrom();
	}
	public function sqlSelect() // For backward compatibility
	{
		return $this->getSqlSelect();
	}
	public function setSqlSelect($v)
	{
		$this->SqlSelect = $v;
	}
	public function getSqlWhere() // Where
	{
		$where = ($this->SqlWhere != "") ? $this->SqlWhere : "";
		$this->TableFilter = "";
		AddFilter($where, $this->TableFilter);
		return $where;
	}
	public function sqlWhere() // For backward compatibility
	{
		return $this->getSqlWhere();
	}
	public function setSqlWhere($v)
	{
		$this->SqlWhere = $v;
	}
	public function getSqlGroupBy() // Group By
	{
		return ($this->SqlGroupBy != "") ? $this->SqlGroupBy : "";
	}
	public function sqlGroupBy() // For backward compatibility
	{
		return $this->getSqlGroupBy();
	}
	public function setSqlGroupBy($v)
	{
		$this->SqlGroupBy = $v;
	}
	public function getSqlHaving() // Having
	{
		return ($this->SqlHaving != "") ? $this->SqlHaving : "";
	}
	public function sqlHaving() // For backward compatibility
	{
		return $this->getSqlHaving();
	}
	public function setSqlHaving($v)
	{
		$this->SqlHaving = $v;
	}
	public function getSqlOrderBy() // Order By
	{
		return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : "";
	}
	public function sqlOrderBy() // For backward compatibility
	{
		return $this->getSqlOrderBy();
	}
	public function setSqlOrderBy($v)
	{
		$this->SqlOrderBy = $v;
	}

	// Apply User ID filters
	public function applyUserIDFilters($filter)
	{
		return $filter;
	}

	// Check if User ID security allows view all
	public function userIDAllow($id = "")
	{
		$allow = Config("USER_ID_ALLOW");
		switch ($id) {
			case "add":
			case "copy":
			case "gridadd":
			case "register":
			case "addopt":
				return (($allow & 1) == 1);
			case "edit":
			case "gridedit":
			case "update":
			case "changepwd":
			case "forgotpwd":
				return (($allow & 4) == 4);
			case "delete":
				return (($allow & 2) == 2);
			case "view":
				return (($allow & 32) == 32);
			case "search":
				return (($allow & 64) == 64);
			default:
				return (($allow & 8) == 8);
		}
	}

	// Get recordset
	public function getRecordset($sql, $rowcnt = -1, $offset = -1)
	{
		$conn = $this->getConnection();
		$conn->raiseErrorFn = Config("ERROR_FUNC");
		$rs = $conn->selectLimit($sql, $rowcnt, $offset);
		$conn->raiseErrorFn = "";
		return $rs;
	}

	// Get record count
	public function getRecordCount($sql, $c = NULL)
	{
		$cnt = -1;
		$rs = NULL;
		$sql = preg_replace('/\/\*BeginOrderBy\*\/[\s\S]+\/\*EndOrderBy\*\//', "", $sql); // Remove ORDER BY clause (MSSQL)
		$pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';

		// Skip Custom View / SubQuery / SELECT DISTINCT / ORDER BY
		if (($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') &&
			preg_match($pattern, $sql) && !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sql) &&
			!preg_match('/^\s*select\s+distinct\s+/i', $sql) && !preg_match('/\s+order\s+by\s+/i', $sql)) {
			$sqlwrk = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sql);
		} else {
			$sqlwrk = "SELECT COUNT(*) FROM (" . $sql . ") COUNT_TABLE";
		}
		$conn = $c ?: $this->getConnection();
		if ($rs = $conn->execute($sqlwrk)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->close();
			}
			return (int)$cnt;
		}

		// Unable to get count, get record count directly
		if ($rs = $conn->execute($sql)) {
			$cnt = $rs->RecordCount();
			$rs->close();
			return (int)$cnt;
		}
		return $cnt;
	}

	// Get SQL
	public function getSql($where, $orderBy = "")
	{
		return BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(),
			$this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(),
			$where, $orderBy);
	}

	// Table SQL
	public function getCurrentSql()
	{
		$filter = $this->CurrentFilter;
		$filter = $this->applyUserIDFilters($filter);
		$sort = $this->getSessionOrderBy();
		return $this->getSql($filter, $sort);
	}

	// Table SQL with List page filter
	public function getListSql()
	{
		$filter = $this->UseSessionForListSql ? $this->getSessionWhere() : "";
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->getSqlSelect();
		$sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
		return BuildSelectSql($select, $this->getSqlWhere(), $this->getSqlGroupBy(),
			$this->getSqlHaving(), $this->getSqlOrderBy(), $filter, $sort);
	}

	// Get ORDER BY clause
	public function getOrderBy()
	{
		$sort = $this->getSessionOrderBy();
		return BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sort);
	}

	// Get record count based on filter (for detail record count in master table pages)
	public function loadRecordCount($filter)
	{
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $filter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
		$cnt = $this->getRecordCount($sql);
		$this->CurrentFilter = $origFilter;
		return $cnt;
	}

	// Get record count (for current List page)
	public function listRecordCount()
	{
		$filter = $this->getSessionWhere();
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
		$cnt = $this->getRecordCount($sql);
		return $cnt;
	}

	// INSERT statement
	protected function insertSql(&$rs)
	{
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom)
				continue;
			$names .= $this->fields[$name]->Expression . ",";
			$values .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$names = preg_replace('/,+$/', "", $names);
		$values = preg_replace('/,+$/', "", $values);
		return "INSERT INTO " . $this->UpdateTable . " ($names) VALUES ($values)";
	}

	// Insert
	public function insert(&$rs)
	{
		$conn = $this->getConnection();
		$success = $conn->execute($this->insertSql($rs));
		if ($success) {

			// Get insert id if necessary
			$this->id_recibo_detalle->setDbValue($conn->insert_ID());
			$rs['id_recibo_detalle'] = $this->id_recibo_detalle->DbValue;
		}
		return $success;
	}

	// UPDATE statement
	protected function updateSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "UPDATE " . $this->UpdateTable . " SET ";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom || $this->fields[$name]->IsAutoIncrement)
				continue;
			$sql .= $this->fields[$name]->Expression . "=";
			$sql .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$sql = preg_replace('/,+$/', "", $sql);
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		AddFilter($filter, $where);
		if ($filter != "")
			$sql .= " WHERE " . $filter;
		return $sql;
	}

	// Update
	public function update(&$rs, $where = "", $rsold = NULL, $curfilter = TRUE)
	{
		$conn = $this->getConnection();
		$success = $conn->execute($this->updateSql($rs, $where, $curfilter));
		return $success;
	}

	// DELETE statement
	protected function deleteSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "DELETE FROM " . $this->UpdateTable . " WHERE ";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		if ($rs) {
			if (array_key_exists('id_recibo_detalle', $rs))
				AddFilter($where, QuotedName('id_recibo_detalle', $this->Dbid) . '=' . QuotedValue($rs['id_recibo_detalle'], $this->id_recibo_detalle->DataType, $this->Dbid));
		}
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		AddFilter($filter, $where);
		if ($filter != "")
			$sql .= $filter;
		else
			$sql .= "0=1"; // Avoid delete
		return $sql;
	}

	// Delete
	public function delete(&$rs, $where = "", $curfilter = FALSE)
	{
		$success = TRUE;
		$conn = $this->getConnection();
		if ($success)
			$success = $conn->execute($this->deleteSql($rs, $where, $curfilter));
		return $success;
	}

	// Load DbValue from recordset or array
	protected function loadDbValues(&$rs)
	{
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id_recibo_detalle->DbValue = $row['id_recibo_detalle'];
		$this->recibo_id->DbValue = $row['recibo_id'];
		$this->gastos_id->DbValue = $row['gastos_id'];
		$this->cantidad->DbValue = $row['cantidad'];
		$this->precio->DbValue = $row['precio'];
		$this->total->DbValue = $row['total'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`id_recibo_detalle` = @id_recibo_detalle@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('id_recibo_detalle', $row) ? $row['id_recibo_detalle'] : NULL;
		else
			$val = $this->id_recibo_detalle->OldValue !== NULL ? $this->id_recibo_detalle->OldValue : $this->id_recibo_detalle->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@id_recibo_detalle@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
		return $keyFilter;
	}

	// Return page URL
	public function getReturnUrl()
	{
		$name = PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL");

		// Get referer URL automatically
		if (ServerVar("HTTP_REFERER") != "" && ReferPageName() != CurrentPageName() && ReferPageName() != "login.php") // Referer not same page or login page
			$_SESSION[$name] = ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] != "") {
			return $_SESSION[$name];
		} else {
			return "recibo_detallelist.php";
		}
	}
	public function setReturnUrl($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL")] = $v;
	}

	// Get modal caption
	public function getModalCaption($pageName)
	{
		global $Language;
		if ($pageName == "recibo_detalleview.php")
			return $Language->phrase("View");
		elseif ($pageName == "recibo_detalleedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "recibo_detalleadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "recibo_detallelist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("recibo_detalleview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("recibo_detalleview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "recibo_detalleadd.php?" . $this->getUrlParm($parm);
		else
			$url = "recibo_detalleadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("recibo_detalleedit.php", $this->getUrlParm($parm));
		return $this->addMasterUrl($url);
	}

	// Inline edit URL
	public function getInlineEditUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=edit"));
		return $this->addMasterUrl($url);
	}

	// Copy URL
	public function getCopyUrl($parm = "")
	{
		$url = $this->keyUrl("recibo_detalleadd.php", $this->getUrlParm($parm));
		return $this->addMasterUrl($url);
	}

	// Inline copy URL
	public function getInlineCopyUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=copy"));
		return $this->addMasterUrl($url);
	}

	// Delete URL
	public function getDeleteUrl()
	{
		return $this->keyUrl("recibo_detalledelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "id_recibo_detalle:" . JsonEncode($this->id_recibo_detalle->CurrentValue, "number");
		$json = "{" . $json . "}";
		if ($htmlEncode)
			$json = HtmlEncode($json);
		return $json;
	}

	// Add key value to URL
	public function keyUrl($url, $parm = "")
	{
		$url = $url . "?";
		if ($parm != "")
			$url .= $parm . "&";
		if ($this->id_recibo_detalle->CurrentValue != NULL) {
			$url .= "id_recibo_detalle=" . urlencode($this->id_recibo_detalle->CurrentValue);
		} else {
			return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
		}
		return $url;
	}

	// Sort URL
	public function sortUrl(&$fld)
	{
		if ($this->CurrentAction || $this->isExport() ||
			in_array($fld->Type, [128, 204, 205])) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$urlParm = $this->getUrlParm("order=" . urlencode($fld->Name) . "&amp;ordertype=" . $fld->reverseSort());
			return $this->addMasterUrl(CurrentPageName() . "?" . $urlParm);
		} else {
			return "";
		}
	}

	// Get record keys from Post/Get/Session
	public function getRecordKeys()
	{
		$arKeys = [];
		$arKey = [];
		if (Param("key_m") !== NULL) {
			$arKeys = Param("key_m");
			$cnt = count($arKeys);
		} else {
			if (Param("id_recibo_detalle") !== NULL)
				$arKeys[] = Param("id_recibo_detalle");
			elseif (IsApi() && Key(0) !== NULL)
				$arKeys[] = Key(0);
			elseif (IsApi() && Route(2) !== NULL)
				$arKeys[] = Route(2);
			else
				$arKeys = NULL; // Do not setup

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = [];
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				if (!is_numeric($key))
					continue;
				$ar[] = $key;
			}
		}
		return $ar;
	}

	// Get filter from record keys
	public function getFilterFromRecordKeys($setCurrent = TRUE)
	{
		$arKeys = $this->getRecordKeys();
		$keyFilter = "";
		foreach ($arKeys as $key) {
			if ($keyFilter != "") $keyFilter .= " OR ";
			if ($setCurrent)
				$this->id_recibo_detalle->CurrentValue = $key;
			else
				$this->id_recibo_detalle->OldValue = $key;
			$keyFilter .= "(" . $this->getRecordFilter() . ")";
		}
		return $keyFilter;
	}

	// Load rows based on filter
	public function &loadRs($filter)
	{

		// Set up filter (WHERE Clause)
		$sql = $this->getSql($filter);
		$conn = $this->getConnection();
		$rs = $conn->execute($sql);
		return $rs;
	}

	// Load row values from recordset
	public function loadListRowValues(&$rs)
	{
		$this->id_recibo_detalle->setDbValue($rs->fields('id_recibo_detalle'));
		$this->recibo_id->setDbValue($rs->fields('recibo_id'));
		$this->gastos_id->setDbValue($rs->fields('gastos_id'));
		$this->cantidad->setDbValue($rs->fields('cantidad'));
		$this->precio->setDbValue($rs->fields('precio'));
		$this->total->setDbValue($rs->fields('total'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// id_recibo_detalle
		// recibo_id
		// gastos_id
		// cantidad
		// precio
		// total
		// id_recibo_detalle

		$this->id_recibo_detalle->ViewValue = $this->id_recibo_detalle->CurrentValue;
		$this->id_recibo_detalle->ViewCustomAttributes = "";

		// recibo_id
		$this->recibo_id->ViewValue = $this->recibo_id->CurrentValue;
		$this->recibo_id->ViewValue = FormatNumber($this->recibo_id->ViewValue, 0, -2, -2, -2);
		$this->recibo_id->ViewCustomAttributes = "";

		// gastos_id
		$this->gastos_id->ViewValue = $this->gastos_id->CurrentValue;
		$this->gastos_id->ViewValue = FormatNumber($this->gastos_id->ViewValue, 0, -2, -2, -2);
		$this->gastos_id->ViewCustomAttributes = "";

		// cantidad
		$this->cantidad->ViewValue = $this->cantidad->CurrentValue;
		$this->cantidad->ViewValue = FormatNumber($this->cantidad->ViewValue, 0, -2, -2, -2);
		$this->cantidad->ViewCustomAttributes = "";

		// precio
		$this->precio->ViewValue = $this->precio->CurrentValue;
		$this->precio->ViewValue = FormatNumber($this->precio->ViewValue, 2, -2, -2, -2);
		$this->precio->ViewCustomAttributes = "";

		// total
		$this->total->ViewValue = $this->total->CurrentValue;
		$this->total->ViewValue = FormatNumber($this->total->ViewValue, 2, -2, -2, -2);
		$this->total->ViewCustomAttributes = "";

		// id_recibo_detalle
		$this->id_recibo_detalle->LinkCustomAttributes = "";
		$this->id_recibo_detalle->HrefValue = "";
		$this->id_recibo_detalle->TooltipValue = "";

		// recibo_id
		$this->recibo_id->LinkCustomAttributes = "";
		$this->recibo_id->HrefValue = "";
		$this->recibo_id->TooltipValue = "";

		// gastos_id
		$this->gastos_id->LinkCustomAttributes = "";
		$this->gastos_id->HrefValue = "";
		$this->gastos_id->TooltipValue = "";

		// cantidad
		$this->cantidad->LinkCustomAttributes = "";
		$this->cantidad->HrefValue = "";
		$this->cantidad->TooltipValue = "";

		// precio
		$this->precio->LinkCustomAttributes = "";
		$this->precio->HrefValue = "";
		$this->precio->TooltipValue = "";

		// total
		$this->total->LinkCustomAttributes = "";
		$this->total->HrefValue = "";
		$this->total->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();

		// Save data for Custom Template
		$this->Rows[] = $this->customTemplateFieldValues();
	}

	// Render edit row values
	public function renderEditRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// id_recibo_detalle
		$this->id_recibo_detalle->EditAttrs["class"] = "form-control";
		$this->id_recibo_detalle->EditCustomAttributes = "";
		$this->id_recibo_detalle->EditValue = $this->id_recibo_detalle->CurrentValue;
		$this->id_recibo_detalle->ViewCustomAttributes = "";

		// recibo_id
		$this->recibo_id->EditAttrs["class"] = "form-control";
		$this->recibo_id->EditCustomAttributes = "";
		$this->recibo_id->EditValue = $this->recibo_id->CurrentValue;
		$this->recibo_id->PlaceHolder = RemoveHtml($this->recibo_id->caption());

		// gastos_id
		$this->gastos_id->EditAttrs["class"] = "form-control";
		$this->gastos_id->EditCustomAttributes = "";
		$this->gastos_id->EditValue = $this->gastos_id->CurrentValue;
		$this->gastos_id->PlaceHolder = RemoveHtml($this->gastos_id->caption());

		// cantidad
		$this->cantidad->EditAttrs["class"] = "form-control";
		$this->cantidad->EditCustomAttributes = "";
		$this->cantidad->EditValue = $this->cantidad->CurrentValue;
		$this->cantidad->PlaceHolder = RemoveHtml($this->cantidad->caption());

		// precio
		$this->precio->EditAttrs["class"] = "form-control";
		$this->precio->EditCustomAttributes = "";
		$this->precio->EditValue = $this->precio->CurrentValue;
		$this->precio->PlaceHolder = RemoveHtml($this->precio->caption());
		if (strval($this->precio->EditValue) != "" && is_numeric($this->precio->EditValue))
			$this->precio->EditValue = FormatNumber($this->precio->EditValue, -2, -2, -2, -2);
		

		// total
		$this->total->EditAttrs["class"] = "form-control";
		$this->total->EditCustomAttributes = "";
		$this->total->EditValue = $this->total->CurrentValue;
		$this->total->PlaceHolder = RemoveHtml($this->total->caption());
		if (strval($this->total->EditValue) != "" && is_numeric($this->total->EditValue))
			$this->total->EditValue = FormatNumber($this->total->EditValue, -2, -2, -2, -2);
		

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	public function aggregateListRowValues()
	{
	}

	// Aggregate list row (for rendering)
	public function aggregateListRow()
	{

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/Email/PDF format
	public function exportDocument($doc, $recordset, $startRec = 1, $stopRec = 1, $exportPageType = "")
	{
		if (!$recordset || !$doc)
			return;
		if (!$doc->ExportCustom) {

			// Write header
			$doc->exportTableHeader();
			if ($doc->Horizontal) { // Horizontal format, write header
				$doc->beginExportRow();
				if ($exportPageType == "view") {
					$doc->exportCaption($this->id_recibo_detalle);
					$doc->exportCaption($this->recibo_id);
					$doc->exportCaption($this->gastos_id);
					$doc->exportCaption($this->cantidad);
					$doc->exportCaption($this->precio);
					$doc->exportCaption($this->total);
				} else {
					$doc->exportCaption($this->id_recibo_detalle);
					$doc->exportCaption($this->recibo_id);
					$doc->exportCaption($this->gastos_id);
					$doc->exportCaption($this->cantidad);
					$doc->exportCaption($this->precio);
					$doc->exportCaption($this->total);
				}
				$doc->endExportRow();
			}
		}

		// Move to first record
		$recCnt = $startRec - 1;
		if (!$recordset->EOF) {
			$recordset->moveFirst();
			if ($startRec > 1)
				$recordset->move($startRec - 1);
		}
		while (!$recordset->EOF && $recCnt < $stopRec) {
			$recCnt++;
			if ($recCnt >= $startRec) {
				$rowCnt = $recCnt - $startRec + 1;

				// Page break
				if ($this->ExportPageBreakCount > 0) {
					if ($rowCnt > 1 && ($rowCnt - 1) % $this->ExportPageBreakCount == 0)
						$doc->exportPageBreak();
				}
				$this->loadListRowValues($recordset);

				// Render row
				$this->RowType = ROWTYPE_VIEW; // Render view
				$this->resetAttributes();
				$this->renderListRow();
				if (!$doc->ExportCustom) {
					$doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
					if ($exportPageType == "view") {
						$doc->exportField($this->id_recibo_detalle);
						$doc->exportField($this->recibo_id);
						$doc->exportField($this->gastos_id);
						$doc->exportField($this->cantidad);
						$doc->exportField($this->precio);
						$doc->exportField($this->total);
					} else {
						$doc->exportField($this->id_recibo_detalle);
						$doc->exportField($this->recibo_id);
						$doc->exportField($this->gastos_id);
						$doc->exportField($this->cantidad);
						$doc->exportField($this->precio);
						$doc->exportField($this->total);
					}
					$doc->endExportRow($rowCnt);
				}
			}

			// Call Row Export server event
			if ($doc->ExportCustom)
				$this->Row_Export($recordset->fields);
			$recordset->moveNext();
		}
		if (!$doc->ExportCustom) {
			$doc->exportTableFooter();
		}
	}

	// Get file data
	public function getFileData($fldparm, $key, $resize, $width = 0, $height = 0)
	{

		// No binary fields
		return FALSE;
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Inserting event
	function Row_Inserting($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated($rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict($rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Grid Inserting event
	function Grid_Inserting() {

		// Enter your code here
		// To reject grid insert, set return value to FALSE

		return TRUE;
	}

	// Grid Inserted event
	function Grid_Inserted($rsnew) {

		//echo "Grid Inserted";
	}

	// Grid Updating event
	function Grid_Updating($rsold) {

		// Enter your code here
		// To reject grid update, set return value to FALSE

		return TRUE;
	}

	// Grid Updated event
	function Grid_Updated($rsold, $rsnew) {

		//echo "Grid Updated";
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending($email, &$args) {

		//var_dump($email); var_dump($args); exit();
		return TRUE;
	}

	// Lookup Selecting event
	function Lookup_Selecting($fld, &$filter) {

		//var_dump($fld->Name, $fld->Lookup, $filter); // Uncomment to view the filter
		// Enter your code here

	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>);

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>