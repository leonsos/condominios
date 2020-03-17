<?php namespace PHPMaker2020\condominios; ?>
<?php

/**
 * Table class for usuarios
 */
class usuarios extends DbTable
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
	public $id_usuario;
	public $nombre_usuario;
	public $clave;
	public $nombres;
	public $apellidos;
	public $cedula;
	public $telefono;
	public $correo;
	public $perfil_id;
	public $memo;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'usuarios';
		$this->TableName = 'usuarios';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`usuarios`";
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

		// id_usuario
		$this->id_usuario = new DbField('usuarios', 'usuarios', 'x_id_usuario', 'id_usuario', '`id_usuario`', '`id_usuario`', 3, 11, -1, FALSE, '`id_usuario`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->id_usuario->IsPrimaryKey = TRUE; // Primary key field
		$this->id_usuario->Nullable = FALSE; // NOT NULL field
		$this->id_usuario->Required = TRUE; // Required field
		$this->id_usuario->Sortable = TRUE; // Allow sort
		$this->id_usuario->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_usuario'] = &$this->id_usuario;

		// nombre_usuario
		$this->nombre_usuario = new DbField('usuarios', 'usuarios', 'x_nombre_usuario', 'nombre_usuario', '`nombre_usuario`', '`nombre_usuario`', 200, 45, -1, FALSE, '`nombre_usuario`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nombre_usuario->Nullable = FALSE; // NOT NULL field
		$this->nombre_usuario->Required = TRUE; // Required field
		$this->nombre_usuario->Sortable = TRUE; // Allow sort
		$this->fields['nombre_usuario'] = &$this->nombre_usuario;

		// clave
		$this->clave = new DbField('usuarios', 'usuarios', 'x_clave', 'clave', '`clave`', '`clave`', 200, 45, -1, FALSE, '`clave`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->clave->Nullable = FALSE; // NOT NULL field
		$this->clave->Required = TRUE; // Required field
		$this->clave->Sortable = TRUE; // Allow sort
		$this->fields['clave'] = &$this->clave;

		// nombres
		$this->nombres = new DbField('usuarios', 'usuarios', 'x_nombres', 'nombres', '`nombres`', '`nombres`', 200, 45, -1, FALSE, '`nombres`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nombres->Nullable = FALSE; // NOT NULL field
		$this->nombres->Required = TRUE; // Required field
		$this->nombres->Sortable = TRUE; // Allow sort
		$this->fields['nombres'] = &$this->nombres;

		// apellidos
		$this->apellidos = new DbField('usuarios', 'usuarios', 'x_apellidos', 'apellidos', '`apellidos`', '`apellidos`', 200, 45, -1, FALSE, '`apellidos`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->apellidos->Nullable = FALSE; // NOT NULL field
		$this->apellidos->Required = TRUE; // Required field
		$this->apellidos->Sortable = TRUE; // Allow sort
		$this->fields['apellidos'] = &$this->apellidos;

		// cedula
		$this->cedula = new DbField('usuarios', 'usuarios', 'x_cedula', 'cedula', '`cedula`', '`cedula`', 3, 11, -1, FALSE, '`cedula`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->cedula->Nullable = FALSE; // NOT NULL field
		$this->cedula->Required = TRUE; // Required field
		$this->cedula->Sortable = TRUE; // Allow sort
		$this->cedula->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['cedula'] = &$this->cedula;

		// telefono
		$this->telefono = new DbField('usuarios', 'usuarios', 'x_telefono', 'telefono', '`telefono`', '`telefono`', 200, 45, -1, FALSE, '`telefono`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->telefono->Nullable = FALSE; // NOT NULL field
		$this->telefono->Required = TRUE; // Required field
		$this->telefono->Sortable = TRUE; // Allow sort
		$this->fields['telefono'] = &$this->telefono;

		// correo
		$this->correo = new DbField('usuarios', 'usuarios', 'x_correo', 'correo', '`correo`', '`correo`', 200, 45, -1, FALSE, '`correo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->correo->Nullable = FALSE; // NOT NULL field
		$this->correo->Required = TRUE; // Required field
		$this->correo->Sortable = TRUE; // Allow sort
		$this->fields['correo'] = &$this->correo;

		// perfil_id
		$this->perfil_id = new DbField('usuarios', 'usuarios', 'x_perfil_id', 'perfil_id', '`perfil_id`', '`perfil_id`', 3, 11, -1, FALSE, '`perfil_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->perfil_id->Nullable = FALSE; // NOT NULL field
		$this->perfil_id->Required = TRUE; // Required field
		$this->perfil_id->Sortable = TRUE; // Allow sort
		$this->perfil_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['perfil_id'] = &$this->perfil_id;

		// memo
		$this->memo = new DbField('usuarios', 'usuarios', 'x_memo', 'memo', '`memo`', '`memo`', 201, 65535, -1, FALSE, '`memo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->memo->Sortable = TRUE; // Allow sort
		$this->fields['memo'] = &$this->memo;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`usuarios`";
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
			if (Config("ENCRYPTED_PASSWORD") && $name == Config("LOGIN_PASSWORD_FIELD_NAME"))
				$value = Config("CASE_SENSITIVE_PASSWORD") ? EncryptPassword($value) : EncryptPassword(strtolower($value));
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
			if (Config("ENCRYPTED_PASSWORD") && $name == Config("LOGIN_PASSWORD_FIELD_NAME")) {
				if ($value == $this->fields[$name]->OldValue) // No need to update hashed password if not changed
					continue;
				$value = Config("CASE_SENSITIVE_PASSWORD") ? EncryptPassword($value) : EncryptPassword(strtolower($value));
			}
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
			if (array_key_exists('id_usuario', $rs))
				AddFilter($where, QuotedName('id_usuario', $this->Dbid) . '=' . QuotedValue($rs['id_usuario'], $this->id_usuario->DataType, $this->Dbid));
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
		$this->id_usuario->DbValue = $row['id_usuario'];
		$this->nombre_usuario->DbValue = $row['nombre_usuario'];
		$this->clave->DbValue = $row['clave'];
		$this->nombres->DbValue = $row['nombres'];
		$this->apellidos->DbValue = $row['apellidos'];
		$this->cedula->DbValue = $row['cedula'];
		$this->telefono->DbValue = $row['telefono'];
		$this->correo->DbValue = $row['correo'];
		$this->perfil_id->DbValue = $row['perfil_id'];
		$this->memo->DbValue = $row['memo'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`id_usuario` = @id_usuario@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('id_usuario', $row) ? $row['id_usuario'] : NULL;
		else
			$val = $this->id_usuario->OldValue !== NULL ? $this->id_usuario->OldValue : $this->id_usuario->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@id_usuario@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "usuarioslist.php";
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
		if ($pageName == "usuariosview.php")
			return $Language->phrase("View");
		elseif ($pageName == "usuariosedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "usuariosadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "usuarioslist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("usuariosview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("usuariosview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "usuariosadd.php?" . $this->getUrlParm($parm);
		else
			$url = "usuariosadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("usuariosedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("usuariosadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("usuariosdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "id_usuario:" . JsonEncode($this->id_usuario->CurrentValue, "number");
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
		if ($this->id_usuario->CurrentValue != NULL) {
			$url .= "id_usuario=" . urlencode($this->id_usuario->CurrentValue);
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
			if (Param("id_usuario") !== NULL)
				$arKeys[] = Param("id_usuario");
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
				$this->id_usuario->CurrentValue = $key;
			else
				$this->id_usuario->OldValue = $key;
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
		$this->id_usuario->setDbValue($rs->fields('id_usuario'));
		$this->nombre_usuario->setDbValue($rs->fields('nombre_usuario'));
		$this->clave->setDbValue($rs->fields('clave'));
		$this->nombres->setDbValue($rs->fields('nombres'));
		$this->apellidos->setDbValue($rs->fields('apellidos'));
		$this->cedula->setDbValue($rs->fields('cedula'));
		$this->telefono->setDbValue($rs->fields('telefono'));
		$this->correo->setDbValue($rs->fields('correo'));
		$this->perfil_id->setDbValue($rs->fields('perfil_id'));
		$this->memo->setDbValue($rs->fields('memo'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// id_usuario
		// nombre_usuario
		// clave
		// nombres
		// apellidos
		// cedula
		// telefono
		// correo
		// perfil_id
		// memo
		// id_usuario

		$this->id_usuario->ViewValue = $this->id_usuario->CurrentValue;
		$this->id_usuario->ViewValue = FormatNumber($this->id_usuario->ViewValue, 0, -2, -2, -2);
		$this->id_usuario->ViewCustomAttributes = "";

		// nombre_usuario
		$this->nombre_usuario->ViewValue = $this->nombre_usuario->CurrentValue;
		$this->nombre_usuario->ViewCustomAttributes = "";

		// clave
		$this->clave->ViewValue = $this->clave->CurrentValue;
		$this->clave->ViewCustomAttributes = "";

		// nombres
		$this->nombres->ViewValue = $this->nombres->CurrentValue;
		$this->nombres->ViewCustomAttributes = "";

		// apellidos
		$this->apellidos->ViewValue = $this->apellidos->CurrentValue;
		$this->apellidos->ViewCustomAttributes = "";

		// cedula
		$this->cedula->ViewValue = $this->cedula->CurrentValue;
		$this->cedula->ViewValue = FormatNumber($this->cedula->ViewValue, 0, -2, -2, -2);
		$this->cedula->ViewCustomAttributes = "";

		// telefono
		$this->telefono->ViewValue = $this->telefono->CurrentValue;
		$this->telefono->ViewCustomAttributes = "";

		// correo
		$this->correo->ViewValue = $this->correo->CurrentValue;
		$this->correo->ViewCustomAttributes = "";

		// perfil_id
		$this->perfil_id->ViewValue = $this->perfil_id->CurrentValue;
		$this->perfil_id->ViewValue = FormatNumber($this->perfil_id->ViewValue, 0, -2, -2, -2);
		$this->perfil_id->ViewCustomAttributes = "";

		// memo
		$this->memo->ViewValue = $this->memo->CurrentValue;
		$this->memo->ViewCustomAttributes = "";

		// id_usuario
		$this->id_usuario->LinkCustomAttributes = "";
		$this->id_usuario->HrefValue = "";
		$this->id_usuario->TooltipValue = "";

		// nombre_usuario
		$this->nombre_usuario->LinkCustomAttributes = "";
		$this->nombre_usuario->HrefValue = "";
		$this->nombre_usuario->TooltipValue = "";

		// clave
		$this->clave->LinkCustomAttributes = "";
		$this->clave->HrefValue = "";
		$this->clave->TooltipValue = "";

		// nombres
		$this->nombres->LinkCustomAttributes = "";
		$this->nombres->HrefValue = "";
		$this->nombres->TooltipValue = "";

		// apellidos
		$this->apellidos->LinkCustomAttributes = "";
		$this->apellidos->HrefValue = "";
		$this->apellidos->TooltipValue = "";

		// cedula
		$this->cedula->LinkCustomAttributes = "";
		$this->cedula->HrefValue = "";
		$this->cedula->TooltipValue = "";

		// telefono
		$this->telefono->LinkCustomAttributes = "";
		$this->telefono->HrefValue = "";
		$this->telefono->TooltipValue = "";

		// correo
		$this->correo->LinkCustomAttributes = "";
		$this->correo->HrefValue = "";
		$this->correo->TooltipValue = "";

		// perfil_id
		$this->perfil_id->LinkCustomAttributes = "";
		$this->perfil_id->HrefValue = "";
		$this->perfil_id->TooltipValue = "";

		// memo
		$this->memo->LinkCustomAttributes = "";
		$this->memo->HrefValue = "";
		$this->memo->TooltipValue = "";

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

		// id_usuario
		$this->id_usuario->EditAttrs["class"] = "form-control";
		$this->id_usuario->EditCustomAttributes = "";
		$this->id_usuario->EditValue = $this->id_usuario->CurrentValue;
		$this->id_usuario->PlaceHolder = RemoveHtml($this->id_usuario->caption());

		// nombre_usuario
		$this->nombre_usuario->EditAttrs["class"] = "form-control";
		$this->nombre_usuario->EditCustomAttributes = "";
		if (!$this->nombre_usuario->Raw)
			$this->nombre_usuario->CurrentValue = HtmlDecode($this->nombre_usuario->CurrentValue);
		$this->nombre_usuario->EditValue = $this->nombre_usuario->CurrentValue;
		$this->nombre_usuario->PlaceHolder = RemoveHtml($this->nombre_usuario->caption());

		// clave
		$this->clave->EditAttrs["class"] = "form-control";
		$this->clave->EditCustomAttributes = "";
		if (!$this->clave->Raw)
			$this->clave->CurrentValue = HtmlDecode($this->clave->CurrentValue);
		$this->clave->EditValue = $this->clave->CurrentValue;
		$this->clave->PlaceHolder = RemoveHtml($this->clave->caption());

		// nombres
		$this->nombres->EditAttrs["class"] = "form-control";
		$this->nombres->EditCustomAttributes = "";
		if (!$this->nombres->Raw)
			$this->nombres->CurrentValue = HtmlDecode($this->nombres->CurrentValue);
		$this->nombres->EditValue = $this->nombres->CurrentValue;
		$this->nombres->PlaceHolder = RemoveHtml($this->nombres->caption());

		// apellidos
		$this->apellidos->EditAttrs["class"] = "form-control";
		$this->apellidos->EditCustomAttributes = "";
		if (!$this->apellidos->Raw)
			$this->apellidos->CurrentValue = HtmlDecode($this->apellidos->CurrentValue);
		$this->apellidos->EditValue = $this->apellidos->CurrentValue;
		$this->apellidos->PlaceHolder = RemoveHtml($this->apellidos->caption());

		// cedula
		$this->cedula->EditAttrs["class"] = "form-control";
		$this->cedula->EditCustomAttributes = "";
		$this->cedula->EditValue = $this->cedula->CurrentValue;
		$this->cedula->PlaceHolder = RemoveHtml($this->cedula->caption());

		// telefono
		$this->telefono->EditAttrs["class"] = "form-control";
		$this->telefono->EditCustomAttributes = "";
		if (!$this->telefono->Raw)
			$this->telefono->CurrentValue = HtmlDecode($this->telefono->CurrentValue);
		$this->telefono->EditValue = $this->telefono->CurrentValue;
		$this->telefono->PlaceHolder = RemoveHtml($this->telefono->caption());

		// correo
		$this->correo->EditAttrs["class"] = "form-control";
		$this->correo->EditCustomAttributes = "";
		if (!$this->correo->Raw)
			$this->correo->CurrentValue = HtmlDecode($this->correo->CurrentValue);
		$this->correo->EditValue = $this->correo->CurrentValue;
		$this->correo->PlaceHolder = RemoveHtml($this->correo->caption());

		// perfil_id
		$this->perfil_id->EditAttrs["class"] = "form-control";
		$this->perfil_id->EditCustomAttributes = "";
		$this->perfil_id->EditValue = $this->perfil_id->CurrentValue;
		$this->perfil_id->PlaceHolder = RemoveHtml($this->perfil_id->caption());

		// memo
		$this->memo->EditAttrs["class"] = "form-control";
		$this->memo->EditCustomAttributes = "";
		$this->memo->EditValue = $this->memo->CurrentValue;
		$this->memo->PlaceHolder = RemoveHtml($this->memo->caption());

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
					$doc->exportCaption($this->id_usuario);
					$doc->exportCaption($this->nombre_usuario);
					$doc->exportCaption($this->clave);
					$doc->exportCaption($this->nombres);
					$doc->exportCaption($this->apellidos);
					$doc->exportCaption($this->cedula);
					$doc->exportCaption($this->telefono);
					$doc->exportCaption($this->correo);
					$doc->exportCaption($this->perfil_id);
					$doc->exportCaption($this->memo);
				} else {
					$doc->exportCaption($this->id_usuario);
					$doc->exportCaption($this->nombre_usuario);
					$doc->exportCaption($this->clave);
					$doc->exportCaption($this->nombres);
					$doc->exportCaption($this->apellidos);
					$doc->exportCaption($this->cedula);
					$doc->exportCaption($this->telefono);
					$doc->exportCaption($this->correo);
					$doc->exportCaption($this->perfil_id);
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
						$doc->exportField($this->id_usuario);
						$doc->exportField($this->nombre_usuario);
						$doc->exportField($this->clave);
						$doc->exportField($this->nombres);
						$doc->exportField($this->apellidos);
						$doc->exportField($this->cedula);
						$doc->exportField($this->telefono);
						$doc->exportField($this->correo);
						$doc->exportField($this->perfil_id);
						$doc->exportField($this->memo);
					} else {
						$doc->exportField($this->id_usuario);
						$doc->exportField($this->nombre_usuario);
						$doc->exportField($this->clave);
						$doc->exportField($this->nombres);
						$doc->exportField($this->apellidos);
						$doc->exportField($this->cedula);
						$doc->exportField($this->telefono);
						$doc->exportField($this->correo);
						$doc->exportField($this->perfil_id);
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