<?php
namespace PHPMaker2020\condominios;

/**
 * Page class
 */
class apartamentos_add extends apartamentos
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{ADBDD478-1F96-44BD-9F21-FE9B46199DE2}";

	// Table name
	public $TableName = 'apartamentos';

	// Page object name
	public $PageObjName = "apartamentos_add";

	// Page headings
	public $Heading = "";
	public $Subheading = "";
	public $PageHeader;
	public $PageFooter;

	// Token
	public $Token = "";
	public $TokenTimeout = 0;
	public $CheckToken;

	// Page heading
	public function pageHeading()
	{
		global $Language;
		if ($this->Heading != "")
			return $this->Heading;
		if (method_exists($this, "tableCaption"))
			return $this->tableCaption();
		return "";
	}

	// Page subheading
	public function pageSubheading()
	{
		global $Language;
		if ($this->Subheading != "")
			return $this->Subheading;
		if ($this->TableName)
			return $Language->phrase($this->PageID);
		return "";
	}

	// Page name
	public function pageName()
	{
		return CurrentPageName();
	}

	// Page URL
	public function pageUrl()
	{
		$url = CurrentPageName() . "?";
		if ($this->UseTokenInUrl)
			$url .= "t=" . $this->TableVar . "&"; // Add page token
		return $url;
	}

	// Messages
	private $_message = "";
	private $_failureMessage = "";
	private $_successMessage = "";
	private $_warningMessage = "";

	// Get message
	public function getMessage()
	{
		return isset($_SESSION[SESSION_MESSAGE]) ? $_SESSION[SESSION_MESSAGE] : $this->_message;
	}

	// Set message
	public function setMessage($v)
	{
		AddMessage($this->_message, $v);
		$_SESSION[SESSION_MESSAGE] = $this->_message;
	}

	// Get failure message
	public function getFailureMessage()
	{
		return isset($_SESSION[SESSION_FAILURE_MESSAGE]) ? $_SESSION[SESSION_FAILURE_MESSAGE] : $this->_failureMessage;
	}

	// Set failure message
	public function setFailureMessage($v)
	{
		AddMessage($this->_failureMessage, $v);
		$_SESSION[SESSION_FAILURE_MESSAGE] = $this->_failureMessage;
	}

	// Get success message
	public function getSuccessMessage()
	{
		return isset($_SESSION[SESSION_SUCCESS_MESSAGE]) ? $_SESSION[SESSION_SUCCESS_MESSAGE] : $this->_successMessage;
	}

	// Set success message
	public function setSuccessMessage($v)
	{
		AddMessage($this->_successMessage, $v);
		$_SESSION[SESSION_SUCCESS_MESSAGE] = $this->_successMessage;
	}

	// Get warning message
	public function getWarningMessage()
	{
		return isset($_SESSION[SESSION_WARNING_MESSAGE]) ? $_SESSION[SESSION_WARNING_MESSAGE] : $this->_warningMessage;
	}

	// Set warning message
	public function setWarningMessage($v)
	{
		AddMessage($this->_warningMessage, $v);
		$_SESSION[SESSION_WARNING_MESSAGE] = $this->_warningMessage;
	}

	// Clear message
	public function clearMessage()
	{
		$this->_message = "";
		$_SESSION[SESSION_MESSAGE] = "";
	}

	// Clear failure message
	public function clearFailureMessage()
	{
		$this->_failureMessage = "";
		$_SESSION[SESSION_FAILURE_MESSAGE] = "";
	}

	// Clear success message
	public function clearSuccessMessage()
	{
		$this->_successMessage = "";
		$_SESSION[SESSION_SUCCESS_MESSAGE] = "";
	}

	// Clear warning message
	public function clearWarningMessage()
	{
		$this->_warningMessage = "";
		$_SESSION[SESSION_WARNING_MESSAGE] = "";
	}

	// Clear messages
	public function clearMessages()
	{
		$this->clearMessage();
		$this->clearFailureMessage();
		$this->clearSuccessMessage();
		$this->clearWarningMessage();
	}

	// Show message
	public function showMessage()
	{
		$hidden = TRUE;
		$html = "";

		// Message
		$message = $this->getMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($message, "");
		if ($message != "") { // Message in Session, display
			if (!$hidden)
				$message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $message;
			$html .= '<div class="alert alert-info alert-dismissible ew-info"><i class="icon fas fa-info"></i>' . $message . '</div>';
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($warningMessage, "warning");
		if ($warningMessage != "") { // Message in Session, display
			if (!$hidden)
				$warningMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $warningMessage;
			$html .= '<div class="alert alert-warning alert-dismissible ew-warning"><i class="icon fas fa-exclamation"></i>' . $warningMessage . '</div>';
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($successMessage, "success");
		if ($successMessage != "") { // Message in Session, display
			if (!$hidden)
				$successMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $successMessage;
			$html .= '<div class="alert alert-success alert-dismissible ew-success"><i class="icon fas fa-check"></i>' . $successMessage . '</div>';
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$errorMessage = $this->getFailureMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($errorMessage, "failure");
		if ($errorMessage != "") { // Message in Session, display
			if (!$hidden)
				$errorMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $errorMessage;
			$html .= '<div class="alert alert-danger alert-dismissible ew-error"><i class="icon fas fa-ban"></i>' . $errorMessage . '</div>';
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo '<div class="ew-message-dialog' . (($hidden) ? ' d-none' : "") . '">' . $html . '</div>';
	}

	// Get message as array
	public function getMessages()
	{
		$ar = [];

		// Message
		$message = $this->getMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($message, "");

		if ($message != "") { // Message in Session, display
			$ar["message"] = $message;
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($warningMessage, "warning");

		if ($warningMessage != "") { // Message in Session, display
			$ar["warningMessage"] = $warningMessage;
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($successMessage, "success");

		if ($successMessage != "") { // Message in Session, display
			$ar["successMessage"] = $successMessage;
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$failureMessage = $this->getFailureMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($failureMessage, "failure");

		if ($failureMessage != "") { // Message in Session, display
			$ar["failureMessage"] = $failureMessage;
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		return $ar;
	}

	// Show Page Header
	public function showPageHeader()
	{
		$header = $this->PageHeader;
		$this->Page_DataRendering($header);
		if ($header != "") { // Header exists, display
			echo '<p id="ew-page-header">' . $header . '</p>';
		}
	}

	// Show Page Footer
	public function showPageFooter()
	{
		$footer = $this->PageFooter;
		$this->Page_DataRendered($footer);
		if ($footer != "") { // Footer exists, display
			echo '<p id="ew-page-footer">' . $footer . '</p>';
		}
	}

	// Validate page request
	protected function isPageRequest()
	{
		global $CurrentForm;
		if ($this->UseTokenInUrl) {
			if ($CurrentForm)
				return ($this->TableVar == $CurrentForm->getValue("t"));
			if (Get("t") !== NULL)
				return ($this->TableVar == Get("t"));
		}
		return TRUE;
	}

	// Valid Post
	protected function validPost()
	{
		if (!$this->CheckToken || !IsPost() || IsApi())
			return TRUE;
		if (Post(Config("TOKEN_NAME")) === NULL)
			return FALSE;
		$fn = Config("CHECK_TOKEN_FUNC");
		if (is_callable($fn))
			return $fn(Post(Config("TOKEN_NAME")), $this->TokenTimeout);
		return FALSE;
	}

	// Create Token
	public function createToken()
	{
		global $CurrentToken;
		$fn = Config("CREATE_TOKEN_FUNC"); // Always create token, required by API file/lookup request
		if ($this->Token == "" && is_callable($fn)) // Create token
			$this->Token = $fn();
		$CurrentToken = $this->Token; // Save to global variable
	}

	// Constructor
	public function __construct()
	{
		global $Language, $DashboardReport;
		global $UserTable;

		// Check token
		$this->CheckToken = Config("CHECK_TOKEN");

		// Initialize
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = SessionTimeoutTime();

		// Language object
		if (!isset($Language))
			$Language = new Language();

		// Parent constuctor
		parent::__construct();

		// Table object (apartamentos)
		if (!isset($GLOBALS["apartamentos"]) || get_class($GLOBALS["apartamentos"]) == PROJECT_NAMESPACE . "apartamentos") {
			$GLOBALS["apartamentos"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["apartamentos"];
		}

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios']))
			$GLOBALS['usuarios'] = new usuarios();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'apartamentos');

		// Start timer
		if (!isset($GLOBALS["DebugTimer"]))
			$GLOBALS["DebugTimer"] = new Timer();

		// Debug message
		LoadDebugMessage();

		// Open connection
		if (!isset($GLOBALS["Conn"]))
			$GLOBALS["Conn"] = $this->getConnection();

		// User table object (usuarios)
		$UserTable = $UserTable ?: new usuarios();
	}

	// Terminate page
	public function terminate($url = "")
	{
		global $ExportFileName, $TempImages, $DashboardReport;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		global $apartamentos;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($apartamentos);
				$doc->Text = @$content;
				if ($this->isExport("email"))
					echo $this->exportEmail($doc->Text);
				else
					$doc->export();
				DeleteTempImages(); // Delete temp images
				exit();
			}
		}
		if (!IsApi())
			$this->Page_Redirecting($url);

		// Close connection
		CloseConnections();

		// Return for API
		if (IsApi()) {
			$res = $url === TRUE;
			if (!$res) // Show error
				WriteJson(array_merge(["success" => FALSE], $this->getMessages()));
			return;
		}

		// Go to URL if specified
		if ($url != "") {
			if (!Config("DEBUG") && ob_get_length())
				ob_end_clean();

			// Handle modal response
			if ($this->IsModal) { // Show as modal
				$row = ["url" => $url, "modal" => "1"];
				$pageName = GetPageName($url);
				if ($pageName != $this->getListUrl()) { // Not List page
					$row["caption"] = $this->getModalCaption($pageName);
					if ($pageName == "apartamentosview.php")
						$row["view"] = "1";
				} else { // List page should not be shown as modal => error
					$row["error"] = $this->getFailureMessage();
					$this->clearFailureMessage();
				}
				WriteJson($row);
			} else {
				SaveDebugMessage();
				AddHeader("Location", $url);
			}
		}
		exit();
	}

	// Get records from recordset
	protected function getRecordsFromRecordset($rs, $current = FALSE)
	{
		$rows = [];
		if (is_object($rs)) { // Recordset
			while ($rs && !$rs->EOF) {
				$this->loadRowValues($rs); // Set up DbValue/CurrentValue
				$row = $this->getRecordFromArray($rs->fields);
				if ($current)
					return $row;
				else
					$rows[] = $row;
				$rs->moveNext();
			}
		} elseif (is_array($rs)) {
			foreach ($rs as $ar) {
				$row = $this->getRecordFromArray($ar);
				if ($current)
					return $row;
				else
					$rows[] = $row;
			}
		}
		return $rows;
	}

	// Get record from array
	protected function getRecordFromArray($ar)
	{
		$row = [];
		if (is_array($ar)) {
			foreach ($ar as $fldname => $val) {
				if (array_key_exists($fldname, $this->fields) && ($this->fields[$fldname]->Visible || $this->fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
					$fld = &$this->fields[$fldname];
					if ($fld->HtmlTag == "FILE") { // Upload field
						if (EmptyValue($val)) {
							$row[$fldname] = NULL;
						} else {
							if ($fld->DataType == DATATYPE_BLOB) {
								$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
									Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
									Config("API_FIELD_NAME") . "=" . $fld->Param . "&" .
									Config("API_KEY_NAME") . "=" . rawurlencode($this->getRecordKeyValue($ar)))); //*** need to add this? API may not be in the same folder
								$row[$fldname] = ["mimeType" => ContentType($val), "url" => $url];
							} elseif (!$fld->UploadMultiple || !ContainsString($val, Config("MULTIPLE_UPLOAD_SEPARATOR"))) { // Single file
								$row[$fldname] = ["mimeType" => MimeContentType($val), "url" => FullUrl($fld->hrefPath() . $val)];
							} else { // Multiple files
								$files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
								$ar = [];
								foreach ($files as $file) {
									if (!EmptyValue($file))
										$ar[] = ["type" => MimeContentType($file), "url" => FullUrl($fld->hrefPath() . $file)];
								}
								$row[$fldname] = $ar;
							}
						}
					} else {
						$row[$fldname] = $val;
					}
				}
			}
		}
		return $row;
	}

	// Get record key value from array
	protected function getRecordKeyValue($ar)
	{
		$key = "";
		if (is_array($ar)) {
			$key .= @$ar['id_apartamento'];
		}
		return $key;
	}

	/**
	 * Hide fields for add/edit
	 *
	 * @return void
	 */
	protected function hideFieldsForAddEdit()
	{
		if ($this->isAdd() || $this->isCopy() || $this->isGridAdd())
			$this->id_apartamento->Visible = FALSE;
	}

	// Lookup data
	public function lookup()
	{
		global $Language, $Security;
		if (!isset($Language))
			$Language = new Language(Config("LANGUAGE_FOLDER"), Post("language", ""));

		// Set up API request
		if (!$this->setupApiRequest())
			return FALSE;

		// Get lookup object
		$fieldName = Post("field");
		if (!array_key_exists($fieldName, $this->fields))
			return FALSE;
		$lookupField = $this->fields[$fieldName];
		$lookup = $lookupField->Lookup;
		if ($lookup === NULL)
			return FALSE;
		$tbl = $lookup->getTable();
		if (!$Security->allowLookup(Config("PROJECT_ID") . $tbl->TableName)) // Lookup permission
			return FALSE;

		// Get lookup parameters
		$lookupType = Post("ajax", "unknown");
		$pageSize = -1;
		$offset = -1;
		$searchValue = "";
		if (SameText($lookupType, "modal")) {
			$searchValue = Post("sv", "");
			$pageSize = Post("recperpage", 10);
			$offset = Post("start", 0);
		} elseif (SameText($lookupType, "autosuggest")) {
			$searchValue = Get("q", "");
			$pageSize = Param("n", -1);
			$pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
			if ($pageSize <= 0)
				$pageSize = Config("AUTO_SUGGEST_MAX_ENTRIES");
			$start = Param("start", -1);
			$start = is_numeric($start) ? (int)$start : -1;
			$page = Param("page", -1);
			$page = is_numeric($page) ? (int)$page : -1;
			$offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
		}
		$userSelect = Decrypt(Post("s", ""));
		$userFilter = Decrypt(Post("f", ""));
		$userOrderBy = Decrypt(Post("o", ""));
		$keys = Post("keys");
		$lookup->LookupType = $lookupType; // Lookup type
		if ($keys !== NULL) { // Selected records from modal
			if (is_array($keys))
				$keys = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $keys);
			$lookup->FilterFields = []; // Skip parent fields if any
			$lookup->FilterValues[] = $keys; // Lookup values
			$pageSize = -1; // Show all records
		} else { // Lookup values
			$lookup->FilterValues[] = Post("v0", Post("lookupValue", ""));
		}
		$cnt = is_array($lookup->FilterFields) ? count($lookup->FilterFields) : 0;
		for ($i = 1; $i <= $cnt; $i++)
			$lookup->FilterValues[] = Post("v" . $i, "");
		$lookup->SearchValue = $searchValue;
		$lookup->PageSize = $pageSize;
		$lookup->Offset = $offset;
		if ($userSelect != "")
			$lookup->UserSelect = $userSelect;
		if ($userFilter != "")
			$lookup->UserFilter = $userFilter;
		if ($userOrderBy != "")
			$lookup->UserOrderBy = $userOrderBy;
		$lookup->toJson($this); // Use settings from current page
	}

	// Set up API request
	public function setupApiRequest()
	{
		global $Security;

		// Check security for API request
		If (ValidApiRequest()) {
			if ($Security->isLoggedIn()) $Security->TablePermission_Loading();
			$Security->loadCurrentUserLevel(Config("PROJECT_ID") . $this->TableName);
			if ($Security->isLoggedIn()) $Security->TablePermission_Loaded();
			return TRUE;
		}
		return FALSE;
	}
	public $FormClassName = "ew-horizontal ew-form ew-add-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;
	public $DbMasterFilter = "";
	public $DbDetailFilter = "";
	public $StartRecord;
	public $Priv = 0;
	public $OldRecordset;
	public $CopyRecord;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
			$FormError, $SkipHeaderFooter;

		// Is modal
		$this->IsModal = (Param("modal") == "1");

		// User profile
		$UserProfile = new UserProfile();

		// Security
		if (!$this->setupApiRequest()) {
			$Security = new AdvancedSecurity();
			if (!$Security->isLoggedIn())
				$Security->autoLogin();
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loading();
			$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName);
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loaded();
			if (!$Security->canAdd()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("apartamentoslist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->id_apartamento->Visible = FALSE;
		$this->propietario_id->setVisibility();
		$this->piso_id->setVisibility();
		$this->metros_cuadrados->setVisibility();
		$this->nombre_numero->setVisibility();
		$this->alicuota->setVisibility();
		$this->hideFieldsForAddEdit();

		// Do not use lookup cache
		$this->setUseLookupCache(FALSE);

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->validPost()) {
			Write($Language->phrase("InvalidPostRequest"));
			$this->terminate();
		}

		// Create Token
		$this->createToken();

		// Set up lookup cache
		// Check modal

		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		$this->FormClassName = "ew-form ew-add-form ew-horizontal";
		$postBack = FALSE;

		// Set up current action
		if (IsApi()) {
			$this->CurrentAction = "insert"; // Add record directly
			$postBack = TRUE;
		} elseif (Post("action") !== NULL) {
			$this->CurrentAction = Post("action"); // Get form action
			$postBack = TRUE;
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (Get("id_apartamento") !== NULL) {
				$this->id_apartamento->setQueryStringValue(Get("id_apartamento"));
				$this->setKey("id_apartamento", $this->id_apartamento->CurrentValue); // Set up key
			} else {
				$this->setKey("id_apartamento", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$this->CurrentAction = "copy"; // Copy record
			} else {
				$this->CurrentAction = "show"; // Display blank record
			}
		}

		// Load old record / default values
		$loaded = $this->loadOldRecord();

		// Load form values
		if ($postBack) {
			$this->loadFormValues(); // Load form values
		}

		// Validate form if post back
		if ($postBack) {
			if (!$this->validateForm()) {
				$this->EventCancelled = TRUE; // Event cancelled
				$this->restoreFormValues(); // Restore form values
				$this->setFailureMessage($FormError);
				if (IsApi()) {
					$this->terminate();
					return;
				} else {
					$this->CurrentAction = "show"; // Form error, reset action
				}
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "copy": // Copy an existing record
				if (!$loaded) { // Record not loaded
					if ($this->getFailureMessage() == "")
						$this->setFailureMessage($Language->phrase("NoRecord")); // No record found
					$this->terminate("apartamentoslist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "apartamentoslist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "apartamentosview.php")
						$returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
					if (IsApi()) { // Return to caller
						$this->terminate(TRUE);
						return;
					} else {
						$this->terminate($returnUrl);
					}
				} elseif (IsApi()) { // API request, return
					$this->terminate();
					return;
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->restoreFormValues(); // Add failed, restore form values
				}
		}

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Render row based on row type
		$this->RowType = ROWTYPE_ADD; // Render add type

		// Render row
		$this->resetAttributes();
		$this->renderRow();
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->id_apartamento->CurrentValue = NULL;
		$this->id_apartamento->OldValue = $this->id_apartamento->CurrentValue;
		$this->propietario_id->CurrentValue = NULL;
		$this->propietario_id->OldValue = $this->propietario_id->CurrentValue;
		$this->piso_id->CurrentValue = NULL;
		$this->piso_id->OldValue = $this->piso_id->CurrentValue;
		$this->metros_cuadrados->CurrentValue = NULL;
		$this->metros_cuadrados->OldValue = $this->metros_cuadrados->CurrentValue;
		$this->nombre_numero->CurrentValue = NULL;
		$this->nombre_numero->OldValue = $this->nombre_numero->CurrentValue;
		$this->alicuota->CurrentValue = NULL;
		$this->alicuota->OldValue = $this->alicuota->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'propietario_id' first before field var 'x_propietario_id'
		$val = $CurrentForm->hasValue("propietario_id") ? $CurrentForm->getValue("propietario_id") : $CurrentForm->getValue("x_propietario_id");
		if (!$this->propietario_id->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->propietario_id->Visible = FALSE; // Disable update for API request
			else
				$this->propietario_id->setFormValue($val);
		}

		// Check field name 'piso_id' first before field var 'x_piso_id'
		$val = $CurrentForm->hasValue("piso_id") ? $CurrentForm->getValue("piso_id") : $CurrentForm->getValue("x_piso_id");
		if (!$this->piso_id->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->piso_id->Visible = FALSE; // Disable update for API request
			else
				$this->piso_id->setFormValue($val);
		}

		// Check field name 'metros_cuadrados' first before field var 'x_metros_cuadrados'
		$val = $CurrentForm->hasValue("metros_cuadrados") ? $CurrentForm->getValue("metros_cuadrados") : $CurrentForm->getValue("x_metros_cuadrados");
		if (!$this->metros_cuadrados->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->metros_cuadrados->Visible = FALSE; // Disable update for API request
			else
				$this->metros_cuadrados->setFormValue($val);
		}

		// Check field name 'nombre_numero' first before field var 'x_nombre_numero'
		$val = $CurrentForm->hasValue("nombre_numero") ? $CurrentForm->getValue("nombre_numero") : $CurrentForm->getValue("x_nombre_numero");
		if (!$this->nombre_numero->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->nombre_numero->Visible = FALSE; // Disable update for API request
			else
				$this->nombre_numero->setFormValue($val);
		}

		// Check field name 'alicuota' first before field var 'x_alicuota'
		$val = $CurrentForm->hasValue("alicuota") ? $CurrentForm->getValue("alicuota") : $CurrentForm->getValue("x_alicuota");
		if (!$this->alicuota->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->alicuota->Visible = FALSE; // Disable update for API request
			else
				$this->alicuota->setFormValue($val);
		}

		// Check field name 'id_apartamento' first before field var 'x_id_apartamento'
		$val = $CurrentForm->hasValue("id_apartamento") ? $CurrentForm->getValue("id_apartamento") : $CurrentForm->getValue("x_id_apartamento");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->propietario_id->CurrentValue = $this->propietario_id->FormValue;
		$this->piso_id->CurrentValue = $this->piso_id->FormValue;
		$this->metros_cuadrados->CurrentValue = $this->metros_cuadrados->FormValue;
		$this->nombre_numero->CurrentValue = $this->nombre_numero->FormValue;
		$this->alicuota->CurrentValue = $this->alicuota->FormValue;
	}

	// Load row based on key values
	public function loadRow()
	{
		global $Security, $Language;
		$filter = $this->getRecordFilter();

		// Call Row Selecting event
		$this->Row_Selecting($filter);

		// Load SQL based on filter
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = $this->getConnection();
		$res = FALSE;
		$rs = LoadRecordset($sql, $conn);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->loadRowValues($rs); // Load row values
			$rs->close();
		}
		return $res;
	}

	// Load row values from recordset
	public function loadRowValues($rs = NULL)
	{
		if ($rs && !$rs->EOF)
			$row = $rs->fields;
		else
			$row = $this->newRow();

		// Call Row Selected event
		$this->Row_Selected($row);
		if (!$rs || $rs->EOF)
			return;
		$this->id_apartamento->setDbValue($row['id_apartamento']);
		$this->propietario_id->setDbValue($row['propietario_id']);
		$this->piso_id->setDbValue($row['piso_id']);
		$this->metros_cuadrados->setDbValue($row['metros_cuadrados']);
		$this->nombre_numero->setDbValue($row['nombre_numero']);
		$this->alicuota->setDbValue($row['alicuota']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['id_apartamento'] = $this->id_apartamento->CurrentValue;
		$row['propietario_id'] = $this->propietario_id->CurrentValue;
		$row['piso_id'] = $this->piso_id->CurrentValue;
		$row['metros_cuadrados'] = $this->metros_cuadrados->CurrentValue;
		$row['nombre_numero'] = $this->nombre_numero->CurrentValue;
		$row['alicuota'] = $this->alicuota->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("id_apartamento")) != "")
			$this->id_apartamento->OldValue = $this->getKey("id_apartamento"); // id_apartamento
		else
			$validKey = FALSE;

		// Load old record
		$this->OldRecordset = NULL;
		if ($validKey) {
			$this->CurrentFilter = $this->getRecordFilter();
			$sql = $this->getCurrentSql();
			$conn = $this->getConnection();
			$this->OldRecordset = LoadRecordset($sql, $conn);
		}
		$this->loadRowValues($this->OldRecordset); // Load row values
		return $validKey;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		// Convert decimal values if posted back

		if ($this->alicuota->FormValue == $this->alicuota->CurrentValue && is_numeric(ConvertToFloatString($this->alicuota->CurrentValue)))
			$this->alicuota->CurrentValue = ConvertToFloatString($this->alicuota->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// id_apartamento
		// propietario_id
		// piso_id
		// metros_cuadrados
		// nombre_numero
		// alicuota

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// id_apartamento
			$this->id_apartamento->ViewValue = $this->id_apartamento->CurrentValue;
			$this->id_apartamento->ViewCustomAttributes = "";

			// propietario_id
			$this->propietario_id->ViewValue = $this->propietario_id->CurrentValue;
			$this->propietario_id->ViewValue = FormatNumber($this->propietario_id->ViewValue, 0, -2, -2, -2);
			$this->propietario_id->ViewCustomAttributes = "";

			// piso_id
			$this->piso_id->ViewValue = $this->piso_id->CurrentValue;
			$this->piso_id->ViewValue = FormatNumber($this->piso_id->ViewValue, 0, -2, -2, -2);
			$this->piso_id->ViewCustomAttributes = "";

			// metros_cuadrados
			$this->metros_cuadrados->ViewValue = $this->metros_cuadrados->CurrentValue;
			$this->metros_cuadrados->ViewCustomAttributes = "";

			// nombre_numero
			$this->nombre_numero->ViewValue = $this->nombre_numero->CurrentValue;
			$this->nombre_numero->ViewCustomAttributes = "";

			// alicuota
			$this->alicuota->ViewValue = $this->alicuota->CurrentValue;
			$this->alicuota->ViewValue = FormatNumber($this->alicuota->ViewValue, 2, -2, -2, -2);
			$this->alicuota->ViewCustomAttributes = "";

			// propietario_id
			$this->propietario_id->LinkCustomAttributes = "";
			$this->propietario_id->HrefValue = "";
			$this->propietario_id->TooltipValue = "";

			// piso_id
			$this->piso_id->LinkCustomAttributes = "";
			$this->piso_id->HrefValue = "";
			$this->piso_id->TooltipValue = "";

			// metros_cuadrados
			$this->metros_cuadrados->LinkCustomAttributes = "";
			$this->metros_cuadrados->HrefValue = "";
			$this->metros_cuadrados->TooltipValue = "";

			// nombre_numero
			$this->nombre_numero->LinkCustomAttributes = "";
			$this->nombre_numero->HrefValue = "";
			$this->nombre_numero->TooltipValue = "";

			// alicuota
			$this->alicuota->LinkCustomAttributes = "";
			$this->alicuota->HrefValue = "";
			$this->alicuota->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// propietario_id
			$this->propietario_id->EditAttrs["class"] = "form-control";
			$this->propietario_id->EditCustomAttributes = "";
			$this->propietario_id->EditValue = HtmlEncode($this->propietario_id->CurrentValue);
			$this->propietario_id->PlaceHolder = RemoveHtml($this->propietario_id->caption());

			// piso_id
			$this->piso_id->EditAttrs["class"] = "form-control";
			$this->piso_id->EditCustomAttributes = "";
			$this->piso_id->EditValue = HtmlEncode($this->piso_id->CurrentValue);
			$this->piso_id->PlaceHolder = RemoveHtml($this->piso_id->caption());

			// metros_cuadrados
			$this->metros_cuadrados->EditAttrs["class"] = "form-control";
			$this->metros_cuadrados->EditCustomAttributes = "";
			if (!$this->metros_cuadrados->Raw)
				$this->metros_cuadrados->CurrentValue = HtmlDecode($this->metros_cuadrados->CurrentValue);
			$this->metros_cuadrados->EditValue = HtmlEncode($this->metros_cuadrados->CurrentValue);
			$this->metros_cuadrados->PlaceHolder = RemoveHtml($this->metros_cuadrados->caption());

			// nombre_numero
			$this->nombre_numero->EditAttrs["class"] = "form-control";
			$this->nombre_numero->EditCustomAttributes = "";
			if (!$this->nombre_numero->Raw)
				$this->nombre_numero->CurrentValue = HtmlDecode($this->nombre_numero->CurrentValue);
			$this->nombre_numero->EditValue = HtmlEncode($this->nombre_numero->CurrentValue);
			$this->nombre_numero->PlaceHolder = RemoveHtml($this->nombre_numero->caption());

			// alicuota
			$this->alicuota->EditAttrs["class"] = "form-control";
			$this->alicuota->EditCustomAttributes = "";
			$this->alicuota->EditValue = HtmlEncode($this->alicuota->CurrentValue);
			$this->alicuota->PlaceHolder = RemoveHtml($this->alicuota->caption());
			if (strval($this->alicuota->EditValue) != "" && is_numeric($this->alicuota->EditValue))
				$this->alicuota->EditValue = FormatNumber($this->alicuota->EditValue, -2, -2, -2, -2);
			

			// Add refer script
			// propietario_id

			$this->propietario_id->LinkCustomAttributes = "";
			$this->propietario_id->HrefValue = "";

			// piso_id
			$this->piso_id->LinkCustomAttributes = "";
			$this->piso_id->HrefValue = "";

			// metros_cuadrados
			$this->metros_cuadrados->LinkCustomAttributes = "";
			$this->metros_cuadrados->HrefValue = "";

			// nombre_numero
			$this->nombre_numero->LinkCustomAttributes = "";
			$this->nombre_numero->HrefValue = "";

			// alicuota
			$this->alicuota->LinkCustomAttributes = "";
			$this->alicuota->HrefValue = "";
		}
		if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->setupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType != ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate form
	protected function validateForm()
	{
		global $Language, $FormError;

		// Initialize form error message
		$FormError = "";

		// Check if validation required
		if (!Config("SERVER_VALIDATE"))
			return ($FormError == "");
		if ($this->propietario_id->Required) {
			if (!$this->propietario_id->IsDetailKey && $this->propietario_id->FormValue != NULL && $this->propietario_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->propietario_id->caption(), $this->propietario_id->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->propietario_id->FormValue)) {
			AddMessage($FormError, $this->propietario_id->errorMessage());
		}
		if ($this->piso_id->Required) {
			if (!$this->piso_id->IsDetailKey && $this->piso_id->FormValue != NULL && $this->piso_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->piso_id->caption(), $this->piso_id->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->piso_id->FormValue)) {
			AddMessage($FormError, $this->piso_id->errorMessage());
		}
		if ($this->metros_cuadrados->Required) {
			if (!$this->metros_cuadrados->IsDetailKey && $this->metros_cuadrados->FormValue != NULL && $this->metros_cuadrados->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->metros_cuadrados->caption(), $this->metros_cuadrados->RequiredErrorMessage));
			}
		}
		if ($this->nombre_numero->Required) {
			if (!$this->nombre_numero->IsDetailKey && $this->nombre_numero->FormValue != NULL && $this->nombre_numero->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->nombre_numero->caption(), $this->nombre_numero->RequiredErrorMessage));
			}
		}
		if ($this->alicuota->Required) {
			if (!$this->alicuota->IsDetailKey && $this->alicuota->FormValue != NULL && $this->alicuota->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->alicuota->caption(), $this->alicuota->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->alicuota->FormValue)) {
			AddMessage($FormError, $this->alicuota->errorMessage());
		}

		// Return validate result
		$validateForm = ($FormError == "");

		// Call Form_CustomValidate event
		$formCustomError = "";
		$validateForm = $validateForm && $this->Form_CustomValidate($formCustomError);
		if ($formCustomError != "") {
			AddMessage($FormError, $formCustomError);
		}
		return $validateForm;
	}

	// Add record
	protected function addRow($rsold = NULL)
	{
		global $Language, $Security;
		$conn = $this->getConnection();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// propietario_id
		$this->propietario_id->setDbValueDef($rsnew, $this->propietario_id->CurrentValue, 0, FALSE);

		// piso_id
		$this->piso_id->setDbValueDef($rsnew, $this->piso_id->CurrentValue, 0, FALSE);

		// metros_cuadrados
		$this->metros_cuadrados->setDbValueDef($rsnew, $this->metros_cuadrados->CurrentValue, "", FALSE);

		// nombre_numero
		$this->nombre_numero->setDbValueDef($rsnew, $this->nombre_numero->CurrentValue, "", FALSE);

		// alicuota
		$this->alicuota->setDbValueDef($rsnew, $this->alicuota->CurrentValue, 0, FALSE);

		// Call Row Inserting event
		$rs = ($rsold) ? $rsold->fields : NULL;
		$insertRow = $this->Row_Inserting($rs, $rsnew);
		if ($insertRow) {
			$conn->raiseErrorFn = Config("ERROR_FUNC");
			$addRow = $this->insert($rsnew);
			$conn->raiseErrorFn = "";
			if ($addRow) {
			}
		} else {
			if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage != "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->phrase("InsertCancelled"));
			}
			$addRow = FALSE;
		}
		if ($addRow) {

			// Call Row Inserted event
			$rs = ($rsold) ? $rsold->fields : NULL;
			$this->Row_Inserted($rs, $rsnew);
		}

		// Clean upload path if any
		if ($addRow) {
		}

		// Write JSON for API request
		if (IsApi() && $addRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $addRow;
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("apartamentoslist.php"), "", $this->TableVar, TRUE);
		$pageId = ($this->isCopy()) ? "Copy" : "Add";
		$Breadcrumb->add("add", $pageId, $url);
	}

	// Setup lookup options
	public function setupLookupOptions($fld)
	{
		if ($fld->Lookup !== NULL && $fld->Lookup->Options === NULL) {

			// Get default connection and filter
			$conn = $this->getConnection();
			$lookupFilter = "";

			// No need to check any more
			$fld->Lookup->Options = [];

			// Set up lookup SQL and connection
			switch ($fld->FieldVar) {
				default:
					$lookupFilter = "";
					break;
			}

			// Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
			$sql = $fld->Lookup->getSql(FALSE, "", $lookupFilter, $this);

			// Set up lookup cache
			if ($fld->UseLookupCache && $sql != "" && count($fld->Lookup->Options) == 0) {
				$totalCnt = $this->getRecordCount($sql, $conn);
				if ($totalCnt > $fld->LookupCacheCount) // Total count > cache count, do not cache
					return;
				$rs = $conn->execute($sql);
				$ar = [];
				while ($rs && !$rs->EOF) {
					$row = &$rs->fields;

					// Format the field values
					switch ($fld->FieldVar) {
					}
					$ar[strval($row[0])] = $row;
					$rs->moveNext();
				}
				if ($rs)
					$rs->close();
				$fld->Lookup->Options = $ar;
			}
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$customError) {

		// Return error message in CustomError
		return TRUE;
	}
} // End class
?>