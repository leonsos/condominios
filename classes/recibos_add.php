<?php
namespace PHPMaker2020\condominios;

/**
 * Page class
 */
class recibos_add extends recibos
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{ADBDD478-1F96-44BD-9F21-FE9B46199DE2}";

	// Table name
	public $TableName = 'recibos';

	// Page object name
	public $PageObjName = "recibos_add";

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

		// Table object (recibos)
		if (!isset($GLOBALS["recibos"]) || get_class($GLOBALS["recibos"]) == PROJECT_NAMESPACE . "recibos") {
			$GLOBALS["recibos"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["recibos"];
		}

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios']))
			$GLOBALS['usuarios'] = new usuarios();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'recibos');

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
		global $recibos;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($recibos);
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
					if ($pageName == "recibosview.php")
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
			$key .= @$ar['id_recibo'];
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
			$this->id_recibo->Visible = FALSE;
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
					$this->terminate(GetUrl("reciboslist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->id_recibo->Visible = FALSE;
		$this->condo_mensual_id->setVisibility();
		$this->apartamento_id->setVisibility();
		$this->n_recibo->setVisibility();
		$this->monto_pagar->setVisibility();
		$this->monto_ind->setVisibility();
		$this->monto_alicuota->setVisibility();
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
			if (Get("id_recibo") !== NULL) {
				$this->id_recibo->setQueryStringValue(Get("id_recibo"));
				$this->setKey("id_recibo", $this->id_recibo->CurrentValue); // Set up key
			} else {
				$this->setKey("id_recibo", ""); // Clear key
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
					$this->terminate("reciboslist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "reciboslist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "recibosview.php")
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
		$this->id_recibo->CurrentValue = NULL;
		$this->id_recibo->OldValue = $this->id_recibo->CurrentValue;
		$this->condo_mensual_id->CurrentValue = NULL;
		$this->condo_mensual_id->OldValue = $this->condo_mensual_id->CurrentValue;
		$this->apartamento_id->CurrentValue = NULL;
		$this->apartamento_id->OldValue = $this->apartamento_id->CurrentValue;
		$this->n_recibo->CurrentValue = NULL;
		$this->n_recibo->OldValue = $this->n_recibo->CurrentValue;
		$this->monto_pagar->CurrentValue = NULL;
		$this->monto_pagar->OldValue = $this->monto_pagar->CurrentValue;
		$this->monto_ind->CurrentValue = NULL;
		$this->monto_ind->OldValue = $this->monto_ind->CurrentValue;
		$this->monto_alicuota->CurrentValue = NULL;
		$this->monto_alicuota->OldValue = $this->monto_alicuota->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'condo_mensual_id' first before field var 'x_condo_mensual_id'
		$val = $CurrentForm->hasValue("condo_mensual_id") ? $CurrentForm->getValue("condo_mensual_id") : $CurrentForm->getValue("x_condo_mensual_id");
		if (!$this->condo_mensual_id->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->condo_mensual_id->Visible = FALSE; // Disable update for API request
			else
				$this->condo_mensual_id->setFormValue($val);
		}

		// Check field name 'apartamento_id' first before field var 'x_apartamento_id'
		$val = $CurrentForm->hasValue("apartamento_id") ? $CurrentForm->getValue("apartamento_id") : $CurrentForm->getValue("x_apartamento_id");
		if (!$this->apartamento_id->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->apartamento_id->Visible = FALSE; // Disable update for API request
			else
				$this->apartamento_id->setFormValue($val);
		}

		// Check field name 'n_recibo' first before field var 'x_n_recibo'
		$val = $CurrentForm->hasValue("n_recibo") ? $CurrentForm->getValue("n_recibo") : $CurrentForm->getValue("x_n_recibo");
		if (!$this->n_recibo->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->n_recibo->Visible = FALSE; // Disable update for API request
			else
				$this->n_recibo->setFormValue($val);
		}

		// Check field name 'monto_pagar' first before field var 'x_monto_pagar'
		$val = $CurrentForm->hasValue("monto_pagar") ? $CurrentForm->getValue("monto_pagar") : $CurrentForm->getValue("x_monto_pagar");
		if (!$this->monto_pagar->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->monto_pagar->Visible = FALSE; // Disable update for API request
			else
				$this->monto_pagar->setFormValue($val);
		}

		// Check field name 'monto_ind' first before field var 'x_monto_ind'
		$val = $CurrentForm->hasValue("monto_ind") ? $CurrentForm->getValue("monto_ind") : $CurrentForm->getValue("x_monto_ind");
		if (!$this->monto_ind->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->monto_ind->Visible = FALSE; // Disable update for API request
			else
				$this->monto_ind->setFormValue($val);
		}

		// Check field name 'monto_alicuota' first before field var 'x_monto_alicuota'
		$val = $CurrentForm->hasValue("monto_alicuota") ? $CurrentForm->getValue("monto_alicuota") : $CurrentForm->getValue("x_monto_alicuota");
		if (!$this->monto_alicuota->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->monto_alicuota->Visible = FALSE; // Disable update for API request
			else
				$this->monto_alicuota->setFormValue($val);
		}

		// Check field name 'id_recibo' first before field var 'x_id_recibo'
		$val = $CurrentForm->hasValue("id_recibo") ? $CurrentForm->getValue("id_recibo") : $CurrentForm->getValue("x_id_recibo");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->condo_mensual_id->CurrentValue = $this->condo_mensual_id->FormValue;
		$this->apartamento_id->CurrentValue = $this->apartamento_id->FormValue;
		$this->n_recibo->CurrentValue = $this->n_recibo->FormValue;
		$this->monto_pagar->CurrentValue = $this->monto_pagar->FormValue;
		$this->monto_ind->CurrentValue = $this->monto_ind->FormValue;
		$this->monto_alicuota->CurrentValue = $this->monto_alicuota->FormValue;
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
		$this->id_recibo->setDbValue($row['id_recibo']);
		$this->condo_mensual_id->setDbValue($row['condo_mensual_id']);
		$this->apartamento_id->setDbValue($row['apartamento_id']);
		$this->n_recibo->setDbValue($row['n_recibo']);
		$this->monto_pagar->setDbValue($row['monto_pagar']);
		$this->monto_ind->setDbValue($row['monto_ind']);
		$this->monto_alicuota->setDbValue($row['monto_alicuota']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['id_recibo'] = $this->id_recibo->CurrentValue;
		$row['condo_mensual_id'] = $this->condo_mensual_id->CurrentValue;
		$row['apartamento_id'] = $this->apartamento_id->CurrentValue;
		$row['n_recibo'] = $this->n_recibo->CurrentValue;
		$row['monto_pagar'] = $this->monto_pagar->CurrentValue;
		$row['monto_ind'] = $this->monto_ind->CurrentValue;
		$row['monto_alicuota'] = $this->monto_alicuota->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("id_recibo")) != "")
			$this->id_recibo->OldValue = $this->getKey("id_recibo"); // id_recibo
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

		if ($this->monto_pagar->FormValue == $this->monto_pagar->CurrentValue && is_numeric(ConvertToFloatString($this->monto_pagar->CurrentValue)))
			$this->monto_pagar->CurrentValue = ConvertToFloatString($this->monto_pagar->CurrentValue);

		// Convert decimal values if posted back
		if ($this->monto_ind->FormValue == $this->monto_ind->CurrentValue && is_numeric(ConvertToFloatString($this->monto_ind->CurrentValue)))
			$this->monto_ind->CurrentValue = ConvertToFloatString($this->monto_ind->CurrentValue);

		// Convert decimal values if posted back
		if ($this->monto_alicuota->FormValue == $this->monto_alicuota->CurrentValue && is_numeric(ConvertToFloatString($this->monto_alicuota->CurrentValue)))
			$this->monto_alicuota->CurrentValue = ConvertToFloatString($this->monto_alicuota->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// id_recibo
		// condo_mensual_id
		// apartamento_id
		// n_recibo
		// monto_pagar
		// monto_ind
		// monto_alicuota

		if ($this->RowType == ROWTYPE_VIEW) { // View row

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
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// condo_mensual_id
			$this->condo_mensual_id->EditAttrs["class"] = "form-control";
			$this->condo_mensual_id->EditCustomAttributes = "";
			$this->condo_mensual_id->EditValue = HtmlEncode($this->condo_mensual_id->CurrentValue);
			$this->condo_mensual_id->PlaceHolder = RemoveHtml($this->condo_mensual_id->caption());

			// apartamento_id
			$this->apartamento_id->EditAttrs["class"] = "form-control";
			$this->apartamento_id->EditCustomAttributes = "";
			$this->apartamento_id->EditValue = HtmlEncode($this->apartamento_id->CurrentValue);
			$this->apartamento_id->PlaceHolder = RemoveHtml($this->apartamento_id->caption());

			// n_recibo
			$this->n_recibo->EditAttrs["class"] = "form-control";
			$this->n_recibo->EditCustomAttributes = "";
			if (!$this->n_recibo->Raw)
				$this->n_recibo->CurrentValue = HtmlDecode($this->n_recibo->CurrentValue);
			$this->n_recibo->EditValue = HtmlEncode($this->n_recibo->CurrentValue);
			$this->n_recibo->PlaceHolder = RemoveHtml($this->n_recibo->caption());

			// monto_pagar
			$this->monto_pagar->EditAttrs["class"] = "form-control";
			$this->monto_pagar->EditCustomAttributes = "";
			$this->monto_pagar->EditValue = HtmlEncode($this->monto_pagar->CurrentValue);
			$this->monto_pagar->PlaceHolder = RemoveHtml($this->monto_pagar->caption());
			if (strval($this->monto_pagar->EditValue) != "" && is_numeric($this->monto_pagar->EditValue))
				$this->monto_pagar->EditValue = FormatNumber($this->monto_pagar->EditValue, -2, -2, -2, -2);
			

			// monto_ind
			$this->monto_ind->EditAttrs["class"] = "form-control";
			$this->monto_ind->EditCustomAttributes = "";
			$this->monto_ind->EditValue = HtmlEncode($this->monto_ind->CurrentValue);
			$this->monto_ind->PlaceHolder = RemoveHtml($this->monto_ind->caption());
			if (strval($this->monto_ind->EditValue) != "" && is_numeric($this->monto_ind->EditValue))
				$this->monto_ind->EditValue = FormatNumber($this->monto_ind->EditValue, -2, -2, -2, -2);
			

			// monto_alicuota
			$this->monto_alicuota->EditAttrs["class"] = "form-control";
			$this->monto_alicuota->EditCustomAttributes = "";
			$this->monto_alicuota->EditValue = HtmlEncode($this->monto_alicuota->CurrentValue);
			$this->monto_alicuota->PlaceHolder = RemoveHtml($this->monto_alicuota->caption());
			if (strval($this->monto_alicuota->EditValue) != "" && is_numeric($this->monto_alicuota->EditValue))
				$this->monto_alicuota->EditValue = FormatNumber($this->monto_alicuota->EditValue, -2, -2, -2, -2);
			

			// Add refer script
			// condo_mensual_id

			$this->condo_mensual_id->LinkCustomAttributes = "";
			$this->condo_mensual_id->HrefValue = "";

			// apartamento_id
			$this->apartamento_id->LinkCustomAttributes = "";
			$this->apartamento_id->HrefValue = "";

			// n_recibo
			$this->n_recibo->LinkCustomAttributes = "";
			$this->n_recibo->HrefValue = "";

			// monto_pagar
			$this->monto_pagar->LinkCustomAttributes = "";
			$this->monto_pagar->HrefValue = "";

			// monto_ind
			$this->monto_ind->LinkCustomAttributes = "";
			$this->monto_ind->HrefValue = "";

			// monto_alicuota
			$this->monto_alicuota->LinkCustomAttributes = "";
			$this->monto_alicuota->HrefValue = "";
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
		if ($this->condo_mensual_id->Required) {
			if (!$this->condo_mensual_id->IsDetailKey && $this->condo_mensual_id->FormValue != NULL && $this->condo_mensual_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->condo_mensual_id->caption(), $this->condo_mensual_id->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->condo_mensual_id->FormValue)) {
			AddMessage($FormError, $this->condo_mensual_id->errorMessage());
		}
		if ($this->apartamento_id->Required) {
			if (!$this->apartamento_id->IsDetailKey && $this->apartamento_id->FormValue != NULL && $this->apartamento_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->apartamento_id->caption(), $this->apartamento_id->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->apartamento_id->FormValue)) {
			AddMessage($FormError, $this->apartamento_id->errorMessage());
		}
		if ($this->n_recibo->Required) {
			if (!$this->n_recibo->IsDetailKey && $this->n_recibo->FormValue != NULL && $this->n_recibo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->n_recibo->caption(), $this->n_recibo->RequiredErrorMessage));
			}
		}
		if ($this->monto_pagar->Required) {
			if (!$this->monto_pagar->IsDetailKey && $this->monto_pagar->FormValue != NULL && $this->monto_pagar->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->monto_pagar->caption(), $this->monto_pagar->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->monto_pagar->FormValue)) {
			AddMessage($FormError, $this->monto_pagar->errorMessage());
		}
		if ($this->monto_ind->Required) {
			if (!$this->monto_ind->IsDetailKey && $this->monto_ind->FormValue != NULL && $this->monto_ind->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->monto_ind->caption(), $this->monto_ind->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->monto_ind->FormValue)) {
			AddMessage($FormError, $this->monto_ind->errorMessage());
		}
		if ($this->monto_alicuota->Required) {
			if (!$this->monto_alicuota->IsDetailKey && $this->monto_alicuota->FormValue != NULL && $this->monto_alicuota->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->monto_alicuota->caption(), $this->monto_alicuota->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->monto_alicuota->FormValue)) {
			AddMessage($FormError, $this->monto_alicuota->errorMessage());
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

		// condo_mensual_id
		$this->condo_mensual_id->setDbValueDef($rsnew, $this->condo_mensual_id->CurrentValue, 0, FALSE);

		// apartamento_id
		$this->apartamento_id->setDbValueDef($rsnew, $this->apartamento_id->CurrentValue, 0, FALSE);

		// n_recibo
		$this->n_recibo->setDbValueDef($rsnew, $this->n_recibo->CurrentValue, "", FALSE);

		// monto_pagar
		$this->monto_pagar->setDbValueDef($rsnew, $this->monto_pagar->CurrentValue, 0, FALSE);

		// monto_ind
		$this->monto_ind->setDbValueDef($rsnew, $this->monto_ind->CurrentValue, 0, FALSE);

		// monto_alicuota
		$this->monto_alicuota->setDbValueDef($rsnew, $this->monto_alicuota->CurrentValue, 0, FALSE);

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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("reciboslist.php"), "", $this->TableVar, TRUE);
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