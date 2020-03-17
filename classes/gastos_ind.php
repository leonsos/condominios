<?php namespace PHPMaker2020\condominios; ?>
<?php

/**
 * Table class for gastos_ind
 */
class gastos_ind extends DbTable
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
	public $id_gasto_ind;
	public $tipo_gasto_id;
	public $monto;
	public $desde;
	public $hasta;
	public $status;
	public $apartamento_id;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'gastos_ind';
		$this->TableName = 'gastos_ind';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`gastos_ind`";
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

		// id_gasto_ind
		$this->id_gasto_ind = new DbField('gastos_ind', 'gastos_ind', 'x_id_gasto_ind', 'id_gasto_ind', '`id_gasto_ind`', '`id_gasto_ind`', 3, 11, -1, FALSE, '`id_gasto_ind`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id_gasto_ind->IsAutoIncrement = TRUE; // Autoincrement field
		$this->id_gasto_ind->IsPrimaryKey = TRUE; // Primary key field
		$this->id_gasto_ind->Sortable = TRUE; // Allow sort
		$this->id_gasto_ind->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_gasto_ind'] = &$this->id_gasto_ind;

		// tipo_gasto_id
		$this->tipo_gasto_id = new DbField('gastos_ind', 'gastos_ind', 'x_tipo_gasto_id', 'tipo_gasto_id', '`tipo_gasto_id`', '`tipo_gasto_id`', 3, 11, -1, FALSE, '`tipo_gasto_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tipo_gasto_id->Nullable = FALSE; // NOT NULL field
		$this->tipo_gasto_id->Required = TRUE; // Required field
		$this->tipo_gasto_id->Sortable = TRUE; // Allow sort
		$this->tipo_gasto_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['tipo_gasto_id'] = &$this->tipo_gasto_id;

		// monto
		$this->monto = new DbField('gastos_ind', 'gastos_ind', 'x_monto', 'monto', '`monto`', '`monto`', 131, 12, -1, FALSE, '`monto`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->monto->Nullable = FALSE; // NOT NULL field
		$this->monto->Required = TRUE; // Required field
		$this->monto->Sortable = TRUE; // Allow sort
		$this->monto->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['monto'] = &$this->monto;

		// desde
		$this->desde = new DbField('gastos_ind', 'gastos_ind', 'x_desde', 'desde', '`desde`', CastDateFieldForLike("`desde`", 0, "DB"), 133, 10, 0, FALSE, '`desde`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->desde->Sortable = TRUE; // Allow sort
		$this->desde->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['desde'] = &$this->desde;

		// hasta
		$this->hasta = new DbField('gastos_ind', 'gastos_ind', 'x_hasta', 'hasta', '`hasta`', CastDateFieldForLike("`hasta`", 0, "DB"), 133, 10, 0, FALSE, '`hasta`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->hasta->Sortable = TRUE; // Allow sort
		$this->hasta->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['hasta'] = &$this->hasta;

		// status
		$this->status = new DbField('gastos_ind', 'gastos_ind', 'x_status', 'status', '`status`', '`status`', 3, 11, -1, FALSE, '`status`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->status->Nullable = FALSE; // NOT NULL field
		$this->status->Required = TRUE; // Required field
		$this->status->Sortable = TRUE; // Allow sort
		$this->status->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['status'] = &$this->status;

		// apartamento_id
		$this->apartamento_id = new DbField('gastos_ind', 'gastos_ind', 'x_apartamento_id', 'apartamento_id', '`apartamento_id`', '`apartamento_id`', 3, 11, -1, FALSE, '`apartamento_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->apartamento_id->Nullable = FALSE; // NOT NULL field
		$this->apartamento_id->Required = TRUE; // Required field
		$this->apartamento_id->Sortable = TRUE; // Allow sort
		$this->apartamento_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['apartamento_id'] = &$this->apartamento_id;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`gastos_ind`";
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
			$this->id_gasto_ind->setDbValue($conn->insert_ID());
			$rs['id_gasto_ind'] = $this->id_gasto_ind->DbValue;
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
			if (array_key_exists('id_gasto_ind', $rs))
				AddFilter($where, QuotedName('id_gasto_ind', $this->Dbid) . '=' . QuotedValue($rs['id_gasto_ind'], $this->id_gasto_ind->DataType, $this->Dbid));
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
		$this->id_gasto_ind->DbValue = $row['id_gasto_ind'];
		$this->tipo_gasto_id->DbValue = $row['tipo_gasto_id'];
		$this->monto->DbValue = $row['monto'];
		$this->desde->DbValue = $row['desde'];
		$this->hasta->DbValue = $row['hasta'];
		$this->status->DbValue = $row['status'];
		$this->apartamento_id->DbValue = $row['apartamento_id'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`id_gasto_ind` = @id_gasto_ind@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('id_gasto_ind', $row) ? $row['id_gasto_ind'] : NULL;
		else
			$val = $this->id_gasto_ind->OldValue !== NULL ? $this->id_gasto_ind->OldValue : $this->id_gasto_ind->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@id_gasto_ind@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "gastos_indlist.php";
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
		if ($pageName == "gastos_indview.php")
			return $Language->phrase("View");
		elseif ($pageName == "gastos_indedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "gastos_indadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "gastos_indlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("gastos_indview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("gastos_indview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "gastos_indadd.php?" . $this->getUrlParm($parm);
		else
			$url = "gastos_indadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("gastos_indedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("gastos_indadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("gastos_inddelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "id_gasto_ind:" . JsonEncode($this->id_gasto_ind->CurrentValue, "number");
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
		if ($this->id_gasto_ind->CurrentValue != NULL) {
			$url .= "id_gasto_ind=" . urlencode($this->id_gasto_ind->CurrentValue);
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
			if (Param("id_gasto_ind") !== NULL)
				$arKeys[] = Param("id_gasto_ind");
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
				$this->id_gasto_ind->CurrentValue = $key;
			else
				$this->id_gasto_ind->OldValue = $key;
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
		$this->id_gasto_ind->setDbValue($rs->fields('id_gasto_ind'));
		$this->tipo_gasto_id->setDbValue($rs->fields('tipo_gasto_id'));
		$this->monto->setDbValue($rs->fields('monto'));
		$this->desde->setDbValue($rs->fields('desde'));
		$this->hasta->setDbValue($rs->fields('hasta'));
		$this->status->setDbValue($rs->fields('status'));
		$this->apartamento_id->setDbValue($rs->fields('apartamento_id'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// id_gasto_ind
		// tipo_gasto_id
		// monto
		// desde
		// hasta
		// status
		// apartamento_id
		// id_gasto_ind

		$this->id_gasto_ind->ViewValue = $this->id_gasto_ind->CurrentValue;
		$this->id_gasto_ind->ViewCustomAttributes = "";

		// tipo_gasto_id
		$this->tipo_gasto_id->ViewValue = $this->tipo_gasto_id->CurrentValue;
		$this->tipo_gasto_id->ViewValue = FormatNumber($this->tipo_gasto_id->ViewValue, 0, -2, -2, -2);
		$this->tipo_gasto_id->ViewCustomAttributes = "";

		// monto
		$this->monto->ViewValue = $this->monto->CurrentValue;
		$this->monto->ViewValue = FormatNumber($this->monto->ViewValue, 2, -2, -2, -2);
		$this->monto->ViewCustomAttributes = "";

		// desde
		$this->desde->ViewValue = $this->desde->CurrentValue;
		$this->desde->ViewValue = FormatDateTime($this->desde->ViewValue, 0);
		$this->desde->ViewCustomAttributes = "";

		// hasta
		$this->hasta->ViewValue = $this->hasta->CurrentValue;
		$this->hasta->ViewValue = FormatDateTime($this->hasta->ViewValue, 0);
		$this->hasta->ViewCustomAttributes = "";

		// status
		$this->status->ViewValue = $this->status->CurrentValue;
		$this->status->ViewValue = FormatNumber($this->status->ViewValue, 0, -2, -2, -2);
		$this->status->ViewCustomAttributes = "";

		// apartamento_id
		$this->apartamento_id->ViewValue = $this->apartamento_id->CurrentValue;
		$this->apartamento_id->ViewValue = FormatNumber($this->apartamento_id->ViewValue, 0, -2, -2, -2);
		$this->apartamento_id->ViewCustomAttributes = "";

		// id_gasto_ind
		$this->id_gasto_ind->LinkCustomAttributes = "";
		$this->id_gasto_ind->HrefValue = "";
		$this->id_gasto_ind->TooltipValue = "";

		// tipo_gasto_id
		$this->tipo_gasto_id->LinkCustomAttributes = "";
		$this->tipo_gasto_id->HrefValue = "";
		$this->tipo_gasto_id->TooltipValue = "";

		// monto
		$this->monto->LinkCustomAttributes = "";
		$this->monto->HrefValue = "";
		$this->monto->TooltipValue = "";

		// desde
		$this->desde->LinkCustomAttributes = "";
		$this->desde->HrefValue = "";
		$this->desde->TooltipValue = "";

		// hasta
		$this->hasta->LinkCustomAttributes = "";
		$this->hasta->HrefValue = "";
		$this->hasta->TooltipValue = "";

		// status
		$this->status->LinkCustomAttributes = "";
		$this->status->HrefValue = "";
		$this->status->TooltipValue = "";

		// apartamento_id
		$this->apartamento_id->LinkCustomAttributes = "";
		$this->apartamento_id->HrefValue = "";
		$this->apartamento_id->TooltipValue = "";

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

		// id_gasto_ind
		$this->id_gasto_ind->EditAttrs["class"] = "form-control";
		$this->id_gasto_ind->EditCustomAttributes = "";
		$this->id_gasto_ind->EditValue = $this->id_gasto_ind->CurrentValue;
		$this->id_gasto_ind->ViewCustomAttributes = "";

		// tipo_gasto_id
		$this->tipo_gasto_id->EditAttrs["class"] = "form-control";
		$this->tipo_gasto_id->EditCustomAttributes = "";
		$this->tipo_gasto_id->EditValue = $this->tipo_gasto_id->CurrentValue;
		$this->tipo_gasto_id->PlaceHolder = RemoveHtml($this->tipo_gasto_id->caption());

		// monto
		$this->monto->EditAttrs["class"] = "form-control";
		$this->monto->EditCustomAttributes = "";
		$this->monto->EditValue = $this->monto->CurrentValue;
		$this->monto->PlaceHolder = RemoveHtml($this->monto->caption());
		if (strval($this->monto->EditValue) != "" && is_numeric($this->monto->EditValue))
			$this->monto->EditValue = FormatNumber($this->monto->EditValue, -2, -2, -2, -2);
		

		// desde
		$this->desde->EditAttrs["class"] = "form-control";
		$this->desde->EditCustomAttributes = "";
		$this->desde->EditValue = FormatDateTime($this->desde->CurrentValue, 8);
		$this->desde->PlaceHolder = RemoveHtml($this->desde->caption());

		// hasta
		$this->hasta->EditAttrs["class"] = "form-control";
		$this->hasta->EditCustomAttributes = "";
		$this->hasta->EditValue = FormatDateTime($this->hasta->CurrentValue, 8);
		$this->hasta->PlaceHolder = RemoveHtml($this->hasta->caption());

		// status
		$this->status->EditAttrs["class"] = "form-control";
		$this->status->EditCustomAttributes = "";
		$this->status->EditValue = $this->status->CurrentValue;
		$this->status->PlaceHolder = RemoveHtml($this->status->caption());

		// apartamento_id
		$this->apartamento_id->EditAttrs["class"] = "form-control";
		$this->apartamento_id->EditCustomAttributes = "";
		$this->apartamento_id->EditValue = $this->apartamento_id->CurrentValue;
		$this->apartamento_id->PlaceHolder = RemoveHtml($this->apartamento_id->caption());

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
					$doc->exportCaption($this->id_gasto_ind);
					$doc->exportCaption($this->tipo_gasto_id);
					$doc->exportCaption($this->monto);
					$doc->exportCaption($this->desde);
					$doc->exportCaption($this->hasta);
					$doc->exportCaption($this->status);
					$doc->exportCaption($this->apartamento_id);
				} else {
					$doc->exportCaption($this->id_gasto_ind);
					$doc->exportCaption($this->tipo_gasto_id);
					$doc->exportCaption($this->monto);
					$doc->exportCaption($this->desde);
					$doc->exportCaption($this->hasta);
					$doc->exportCaption($this->status);
					$doc->exportCaption($this->apartamento_id);
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
						$doc->exportField($this->id_gasto_ind);
						$doc->exportField($this->tipo_gasto_id);
						$doc->exportField($this->monto);
						$doc->exportField($this->desde);
						$doc->exportField($this->hasta);
						$doc->exportField($this->status);
						$doc->exportField($this->apartamento_id);
					} else {
						$doc->exportField($this->id_gasto_ind);
						$doc->exportField($this->tipo_gasto_id);
						$doc->exportField($this->monto);
						$doc->exportField($this->desde);
						$doc->exportField($this->hasta);
						$doc->exportField($this->status);
						$doc->exportField($this->apartamento_id);
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