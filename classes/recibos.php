<?php namespace PHPMaker2020\condominios; ?>
<?php

/**
 * Table class for recibos
 */
class recibos extends DbTable
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
	public $id_recibo;
	public $condo_mensual_id;
	public $apartamento_id;
	public $n_recibo;
	public $monto_pagar;
	public $monto_ind;
	public $monto_alicuota;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'recibos';
		$this->TableName = 'recibos';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`recibos`";
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

		// id_recibo
		$this->id_recibo = new DbField('recibos', 'recibos', 'x_id_recibo', 'id_recibo', '`id_recibo`', '`id_recibo`', 3, 11, -1, FALSE, '`id_recibo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id_recibo->IsAutoIncrement = TRUE; // Autoincrement field
		$this->id_recibo->IsPrimaryKey = TRUE; // Primary key field
		$this->id_recibo->Sortable = TRUE; // Allow sort
		$this->id_recibo->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_recibo'] = &$this->id_recibo;

		// condo_mensual_id
		$this->condo_mensual_id = new DbField('recibos', 'recibos', 'x_condo_mensual_id', 'condo_mensual_id', '`condo_mensual_id`', '`condo_mensual_id`', 3, 11, -1, FALSE, '`condo_mensual_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->condo_mensual_id->Nullable = FALSE; // NOT NULL field
		$this->condo_mensual_id->Required = TRUE; // Required field
		$this->condo_mensual_id->Sortable = TRUE; // Allow sort
		$this->condo_mensual_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['condo_mensual_id'] = &$this->condo_mensual_id;

		// apartamento_id
		$this->apartamento_id = new DbField('recibos', 'recibos', 'x_apartamento_id', 'apartamento_id', '`apartamento_id`', '`apartamento_id`', 3, 11, -1, FALSE, '`apartamento_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->apartamento_id->Nullable = FALSE; // NOT NULL field
		$this->apartamento_id->Required = TRUE; // Required field
		$this->apartamento_id->Sortable = TRUE; // Allow sort
		$this->apartamento_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['apartamento_id'] = &$this->apartamento_id;

		// n_recibo
		$this->n_recibo = new DbField('recibos', 'recibos', 'x_n_recibo', 'n_recibo', '`n_recibo`', '`n_recibo`', 200, 45, -1, FALSE, '`n_recibo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->n_recibo->Nullable = FALSE; // NOT NULL field
		$this->n_recibo->Required = TRUE; // Required field
		$this->n_recibo->Sortable = TRUE; // Allow sort
		$this->fields['n_recibo'] = &$this->n_recibo;

		// monto_pagar
		$this->monto_pagar = new DbField('recibos', 'recibos', 'x_monto_pagar', 'monto_pagar', '`monto_pagar`', '`monto_pagar`', 131, 12, -1, FALSE, '`monto_pagar`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->monto_pagar->Nullable = FALSE; // NOT NULL field
		$this->monto_pagar->Required = TRUE; // Required field
		$this->monto_pagar->Sortable = TRUE; // Allow sort
		$this->monto_pagar->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['monto_pagar'] = &$this->monto_pagar;

		// monto_ind
		$this->monto_ind = new DbField('recibos', 'recibos', 'x_monto_ind', 'monto_ind', '`monto_ind`', '`monto_ind`', 131, 12, -1, FALSE, '`monto_ind`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->monto_ind->Nullable = FALSE; // NOT NULL field
		$this->monto_ind->Required = TRUE; // Required field
		$this->monto_ind->Sortable = TRUE; // Allow sort
		$this->monto_ind->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['monto_ind'] = &$this->monto_ind;

		// monto_alicuota
		$this->monto_alicuota = new DbField('recibos', 'recibos', 'x_monto_alicuota', 'monto_alicuota', '`monto_alicuota`', '`monto_alicuota`', 131, 12, -1, FALSE, '`monto_alicuota`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->monto_alicuota->Nullable = FALSE; // NOT NULL field
		$this->monto_alicuota->Required = TRUE; // Required field
		$this->monto_alicuota->Sortable = TRUE; // Allow sort
		$this->monto_alicuota->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['monto_alicuota'] = &$this->monto_alicuota;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`recibos`";
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
			$this->id_recibo->setDbValue($conn->insert_ID());
			$rs['id_recibo'] = $this->id_recibo->DbValue;
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
			if (array_key_exists('id_recibo', $rs))
				AddFilter($where, QuotedName('id_recibo', $this->Dbid) . '=' . QuotedValue($rs['id_recibo'], $this->id_recibo->DataType, $this->Dbid));
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
		$this->id_recibo->DbValue = $row['id_recibo'];
		$this->condo_mensual_id->DbValue = $row['condo_mensual_id'];
		$this->apartamento_id->DbValue = $row['apartamento_id'];
		$this->n_recibo->DbValue = $row['n_recibo'];
		$this->monto_pagar->DbValue = $row['monto_pagar'];
		$this->monto_ind->DbValue = $row['monto_ind'];
		$this->monto_alicuota->DbValue = $row['monto_alicuota'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`id_recibo` = @id_recibo@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('id_recibo', $row) ? $row['id_recibo'] : NULL;
		else
			$val = $this->id_recibo->OldValue !== NULL ? $this->id_recibo->OldValue : $this->id_recibo->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@id_recibo@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "reciboslist.php";
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
		if ($pageName == "recibosview.php")
			return $Language->phrase("View");
		elseif ($pageName == "recibosedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "recibosadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "reciboslist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("recibosview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("recibosview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "recibosadd.php?" . $this->getUrlParm($parm);
		else
			$url = "recibosadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("recibosedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("recibosadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("recibosdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "id_recibo:" . JsonEncode($this->id_recibo->CurrentValue, "number");
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
		if ($this->id_recibo->CurrentValue != NULL) {
			$url .= "id_recibo=" . urlencode($this->id_recibo->CurrentValue);
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
			if (Param("id_recibo") !== NULL)
				$arKeys[] = Param("id_recibo");
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
				$this->id_recibo->CurrentValue = $key;
			else
				$this->id_recibo->OldValue = $key;
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
		$this->id_recibo->setDbValue($rs->fields('id_recibo'));
		$this->condo_mensual_id->setDbValue($rs->fields('condo_mensual_id'));
		$this->apartamento_id->setDbValue($rs->fields('apartamento_id'));
		$this->n_recibo->setDbValue($rs->fields('n_recibo'));
		$this->monto_pagar->setDbValue($rs->fields('monto_pagar'));
		$this->monto_ind->setDbValue($rs->fields('monto_ind'));
		$this->monto_alicuota->setDbValue($rs->fields('monto_alicuota'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// id_recibo
		// condo_mensual_id
		// apartamento_id
		// n_recibo
		// monto_pagar
		// monto_ind
		// monto_alicuota
		// id_recibo

		$this->id_recibo->ViewValue = $this->id_recibo->CurrentValue;
		$this->id_recibo->ViewCustomAttributes = "";

		// condo_mensual_id
		$this->condo_mensual_id->ViewValue = $this->condo_mensual_id->CurrentValue;
		$this->condo_mensual_id->ViewValue = FormatNumber($this->condo_mensual_id->ViewValue, 0, -2, -2, -2);
		$this->condo_mensual_id->ViewCustomAttributes = "";

		// apartamento_id
		$this->apartamento_id->ViewValue = $this->apartamento_id->CurrentValue;
		$this->apartamento_id->ViewValue = FormatNumber($this->apartamento_id->ViewValue, 0, -2, -2, -2);
		$this->apartamento_id->ViewCustomAttributes = "";

		// n_recibo
		$this->n_recibo->ViewValue = $this->n_recibo->CurrentValue;
		$this->n_recibo->ViewCustomAttributes = "";

		// monto_pagar
		$this->monto_pagar->ViewValue = $this->monto_pagar->CurrentValue;
		$this->monto_pagar->ViewValue = FormatNumber($this->monto_pagar->ViewValue, 2, -2, -2, -2);
		$this->monto_pagar->ViewCustomAttributes = "";

		// monto_ind
		$this->monto_ind->ViewValue = $this->monto_ind->CurrentValue;
		$this->monto_ind->ViewValue = FormatNumber($this->monto_ind->ViewValue, 2, -2, -2, -2);
		$this->monto_ind->ViewCustomAttributes = "";

		// monto_alicuota
		$this->monto_alicuota->ViewValue = $this->monto_alicuota->CurrentValue;
		$this->monto_alicuota->ViewValue = FormatNumber($this->monto_alicuota->ViewValue, 2, -2, -2, -2);
		$this->monto_alicuota->ViewCustomAttributes = "";

		// id_recibo
		$this->id_recibo->LinkCustomAttributes = "";
		$this->id_recibo->HrefValue = "";
		$this->id_recibo->TooltipValue = "";

		// condo_mensual_id
		$this->condo_mensual_id->LinkCustomAttributes = "";
		$this->condo_mensual_id->HrefValue = "";
		$this->condo_mensual_id->TooltipValue = "";

		// apartamento_id
		$this->apartamento_id->LinkCustomAttributes = "";
		$this->apartamento_id->HrefValue = "";
		$this->apartamento_id->TooltipValue = "";

		// n_recibo
		$this->n_recibo->LinkCustomAttributes = "";
		$this->n_recibo->HrefValue = "";
		$this->n_recibo->TooltipValue = "";

		// monto_pagar
		$this->monto_pagar->LinkCustomAttributes = "";
		$this->monto_pagar->HrefValue = "";
		$this->monto_pagar->TooltipValue = "";

		// monto_ind
		$this->monto_ind->LinkCustomAttributes = "";
		$this->monto_ind->HrefValue = "";
		$this->monto_ind->TooltipValue = "";

		// monto_alicuota
		$this->monto_alicuota->LinkCustomAttributes = "";
		$this->monto_alicuota->HrefValue = "";
		$this->monto_alicuota->TooltipValue = "";

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

		// id_recibo
		$this->id_recibo->EditAttrs["class"] = "form-control";
		$this->id_recibo->EditCustomAttributes = "";
		$this->id_recibo->EditValue = $this->id_recibo->CurrentValue;
		$this->id_recibo->ViewCustomAttributes = "";

		// condo_mensual_id
		$this->condo_mensual_id->EditAttrs["class"] = "form-control";
		$this->condo_mensual_id->EditCustomAttributes = "";
		$this->condo_mensual_id->EditValue = $this->condo_mensual_id->CurrentValue;
		$this->condo_mensual_id->PlaceHolder = RemoveHtml($this->condo_mensual_id->caption());

		// apartamento_id
		$this->apartamento_id->EditAttrs["class"] = "form-control";
		$this->apartamento_id->EditCustomAttributes = "";
		$this->apartamento_id->EditValue = $this->apartamento_id->CurrentValue;
		$this->apartamento_id->PlaceHolder = RemoveHtml($this->apartamento_id->caption());

		// n_recibo
		$this->n_recibo->EditAttrs["class"] = "form-control";
		$this->n_recibo->EditCustomAttributes = "";
		if (!$this->n_recibo->Raw)
			$this->n_recibo->CurrentValue = HtmlDecode($this->n_recibo->CurrentValue);
		$this->n_recibo->EditValue = $this->n_recibo->CurrentValue;
		$this->n_recibo->PlaceHolder = RemoveHtml($this->n_recibo->caption());

		// monto_pagar
		$this->monto_pagar->EditAttrs["class"] = "form-control";
		$this->monto_pagar->EditCustomAttributes = "";
		$this->monto_pagar->EditValue = $this->monto_pagar->CurrentValue;
		$this->monto_pagar->PlaceHolder = RemoveHtml($this->monto_pagar->caption());
		if (strval($this->monto_pagar->EditValue) != "" && is_numeric($this->monto_pagar->EditValue))
			$this->monto_pagar->EditValue = FormatNumber($this->monto_pagar->EditValue, -2, -2, -2, -2);
		

		// monto_ind
		$this->monto_ind->EditAttrs["class"] = "form-control";
		$this->monto_ind->EditCustomAttributes = "";
		$this->monto_ind->EditValue = $this->monto_ind->CurrentValue;
		$this->monto_ind->PlaceHolder = RemoveHtml($this->monto_ind->caption());
		if (strval($this->monto_ind->EditValue) != "" && is_numeric($this->monto_ind->EditValue))
			$this->monto_ind->EditValue = FormatNumber($this->monto_ind->EditValue, -2, -2, -2, -2);
		

		// monto_alicuota
		$this->monto_alicuota->EditAttrs["class"] = "form-control";
		$this->monto_alicuota->EditCustomAttributes = "";
		$this->monto_alicuota->EditValue = $this->monto_alicuota->CurrentValue;
		$this->monto_alicuota->PlaceHolder = RemoveHtml($this->monto_alicuota->caption());
		if (strval($this->monto_alicuota->EditValue) != "" && is_numeric($this->monto_alicuota->EditValue))
			$this->monto_alicuota->EditValue = FormatNumber($this->monto_alicuota->EditValue, -2, -2, -2, -2);
		

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
					$doc->exportCaption($this->id_recibo);
					$doc->exportCaption($this->condo_mensual_id);
					$doc->exportCaption($this->apartamento_id);
					$doc->exportCaption($this->n_recibo);
					$doc->exportCaption($this->monto_pagar);
					$doc->exportCaption($this->monto_ind);
					$doc->exportCaption($this->monto_alicuota);
				} else {
					$doc->exportCaption($this->id_recibo);
					$doc->exportCaption($this->condo_mensual_id);
					$doc->exportCaption($this->apartamento_id);
					$doc->exportCaption($this->n_recibo);
					$doc->exportCaption($this->monto_pagar);
					$doc->exportCaption($this->monto_ind);
					$doc->exportCaption($this->monto_alicuota);
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
						$doc->exportField($this->id_recibo);
						$doc->exportField($this->condo_mensual_id);
						$doc->exportField($this->apartamento_id);
						$doc->exportField($this->n_recibo);
						$doc->exportField($this->monto_pagar);
						$doc->exportField($this->monto_ind);
						$doc->exportField($this->monto_alicuota);
					} else {
						$doc->exportField($this->id_recibo);
						$doc->exportField($this->condo_mensual_id);
						$doc->exportField($this->apartamento_id);
						$doc->exportField($this->n_recibo);
						$doc->exportField($this->monto_pagar);
						$doc->exportField($this->monto_ind);
						$doc->exportField($this->monto_alicuota);
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