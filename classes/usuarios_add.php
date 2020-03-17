<?php
namespace PHPMaker2020\condominios;

/**
 * Page class
 */
class usuarios_add extends usuarios
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{ADBDD478-1F96-44BD-9F21-FE9B46199DE2}";

	// Table name
	public $TableName = 'usuarios';

	// Page object name
	public $PageObjName = "usuarios_add";

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

		// Table object (usuarios)
		if (!isset($GLOBALS["usuarios"]) || get_class($GLOBALS["usuarios"]) == PROJECT_NAMESPACE . "usuarios") {
			$GLOBALS["usuarios"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["usuarios"];
		}

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'usuarios');

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
		global $usuarios;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($usuarios);
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
					if ($pageName == "usuariosview.php")
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
			$key .= @$ar['id_usuario'];
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
					$this->terminate(GetUrl("usuarioslist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->id_usuario->setVisibility();
		$this->nombre_usuario->setVisibility();
		$this->clave->setVisibility();
		$this->nombres->setVisibility();
		$this->apellidos->setVisibility();
		$this->cedula->setVisibility();
		$this->telefono->setVisibility();
		$this->correo->setVisibility();
		$this->perfil_id->setVisibility();
		$this->memo->setVisibility();
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
			if (Get("id_usuario") !== NULL) {
				$this->id_usuario->setQueryStringValue(Get("id_usuario"));
				$this->setKey("id_usuario", $this->id_usuario->CurrentValue); // Set up key
			} else {
				$this->setKey("id_usuario", ""); // Clear key
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
					$this->terminate("usuarioslist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "usuarioslist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "usuariosview.php")
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
		$this->id_usuario->CurrentValue = NULL;
		$this->id_usuario->OldValue = $this->id_usuario->CurrentValue;
		$this->nombre_usuario->CurrentValue = NULL;
		$this->nombre_usuario->OldValue = $this->nombre_usuario->CurrentValue;
		$this->clave->CurrentValue = NULL;
		$this->clave->OldValue = $this->clave->CurrentValue;
		$this->nombres->CurrentValue = NULL;
		$this->nombres->OldValue = $this->nombres->CurrentValue;
		$this->apellidos->CurrentValue = NULL;
		$this->apellidos->OldValue = $this->apellidos->CurrentValue;
		$this->cedula->CurrentValue = NULL;
		$this->cedula->OldValue = $this->cedula->CurrentValue;
		$this->telefono->CurrentValue = NULL;
		$this->telefono->OldValue = $this->telefono->CurrentValue;
		$this->correo->CurrentValue = NULL;
		$this->correo->OldValue = $this->correo->CurrentValue;
		$this->perfil_id->CurrentValue = 0;
		$this->memo->CurrentValue = NULL;
		$this->memo->OldValue = $this->memo->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'id_usuario' first before field var 'x_id_usuario'
		$val = $CurrentForm->hasValue("id_usuario") ? $CurrentForm->getValue("id_usuario") : $CurrentForm->getValue("x_id_usuario");
		if (!$this->id_usuario->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->id_usuario->Visible = FALSE; // Disable update for API request
			else
				$this->id_usuario->setFormValue($val);
		}

		// Check field name 'nombre_usuario' first before field var 'x_nombre_usuario'
		$val = $CurrentForm->hasValue("nombre_usuario") ? $CurrentForm->getValue("nombre_usuario") : $CurrentForm->getValue("x_nombre_usuario");
		if (!$this->nombre_usuario->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->nombre_usuario->Visible = FALSE; // Disable update for API request
			else
				$this->nombre_usuario->setFormValue($val);
		}

		// Check field name 'clave' first before field var 'x_clave'
		$val = $CurrentForm->hasValue("clave") ? $CurrentForm->getValue("clave") : $CurrentForm->getValue("x_clave");
		if (!$this->clave->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->clave->Visible = FALSE; // Disable update for API request
			else
				if (Config("ENCRYPTED_PASSWORD")) // Encrypted password, use raw value
					$this->clave->setRawFormValue($val);
				else
					$this->clave->setFormValue($val);
		}

		// Check field name 'nombres' first before field var 'x_nombres'
		$val = $CurrentForm->hasValue("nombres") ? $CurrentForm->getValue("nombres") : $CurrentForm->getValue("x_nombres");
		if (!$this->nombres->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->nombres->Visible = FALSE; // Disable update for API request
			else
				$this->nombres->setFormValue($val);
		}

		// Check field name 'apellidos' first before field var 'x_apellidos'
		$val = $CurrentForm->hasValue("apellidos") ? $CurrentForm->getValue("apellidos") : $CurrentForm->getValue("x_apellidos");
		if (!$this->apellidos->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->apellidos->Visible = FALSE; // Disable update for API request
			else
				$this->apellidos->setFormValue($val);
		}

		// Check field name 'cedula' first before field var 'x_cedula'
		$val = $CurrentForm->hasValue("cedula") ? $CurrentForm->getValue("cedula") : $CurrentForm->getValue("x_cedula");
		if (!$this->cedula->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->cedula->Visible = FALSE; // Disable update for API request
			else
				$this->cedula->setFormValue($val);
		}

		// Check field name 'telefono' first before field var 'x_telefono'
		$val = $CurrentForm->hasValue("telefono") ? $CurrentForm->getValue("telefono") : $CurrentForm->getValue("x_telefono");
		if (!$this->telefono->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->telefono->Visible = FALSE; // Disable update for API request
			else
				$this->telefono->setFormValue($val);
		}

		// Check field name 'correo' first before field var 'x_correo'
		$val = $CurrentForm->hasValue("correo") ? $CurrentForm->getValue("correo") : $CurrentForm->getValue("x_correo");
		if (!$this->correo->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->correo->Visible = FALSE; // Disable update for API request
			else
				$this->correo->setFormValue($val);
		}

		// Check field name 'perfil_id' first before field var 'x_perfil_id'
		$val = $CurrentForm->hasValue("perfil_id") ? $CurrentForm->getValue("perfil_id") : $CurrentForm->getValue("x_perfil_id");
		if (!$this->perfil_id->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->perfil_id->Visible = FALSE; // Disable update for API request
			else
				$this->perfil_id->setFormValue($val);
		}

		// Check field name 'memo' first before field var 'x_memo'
		$val = $CurrentForm->hasValue("memo") ? $CurrentForm->getValue("memo") : $CurrentForm->getValue("x_memo");
		if (!$this->memo->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->memo->Visible = FALSE; // Disable update for API request
			else
				$this->memo->setFormValue($val);
		}
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->id_usuario->CurrentValue = $this->id_usuario->FormValue;
		$this->nombre_usuario->CurrentValue = $this->nombre_usuario->FormValue;
		$this->clave->CurrentValue = $this->clave->FormValue;
		$this->nombres->CurrentValue = $this->nombres->FormValue;
		$this->apellidos->CurrentValue = $this->apellidos->FormValue;
		$this->cedula->CurrentValue = $this->cedula->FormValue;
		$this->telefono->CurrentValue = $this->telefono->FormValue;
		$this->correo->CurrentValue = $this->correo->FormValue;
		$this->perfil_id->CurrentValue = $this->perfil_id->FormValue;
		$this->memo->CurrentValue = $this->memo->FormValue;
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
		$this->id_usuario->setDbValue($row['id_usuario']);
		$this->nombre_usuario->setDbValue($row['nombre_usuario']);
		$this->clave->setDbValue($row['clave']);
		$this->nombres->setDbValue($row['nombres']);
		$this->apellidos->setDbValue($row['apellidos']);
		$this->cedula->setDbValue($row['cedula']);
		$this->telefono->setDbValue($row['telefono']);
		$this->correo->setDbValue($row['correo']);
		$this->perfil_id->setDbValue($row['perfil_id']);
		$this->memo->setDbValue($row['memo']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['id_usuario'] = $this->id_usuario->CurrentValue;
		$row['nombre_usuario'] = $this->nombre_usuario->CurrentValue;
		$row['clave'] = $this->clave->CurrentValue;
		$row['nombres'] = $this->nombres->CurrentValue;
		$row['apellidos'] = $this->apellidos->CurrentValue;
		$row['cedula'] = $this->cedula->CurrentValue;
		$row['telefono'] = $this->telefono->CurrentValue;
		$row['correo'] = $this->correo->CurrentValue;
		$row['perfil_id'] = $this->perfil_id->CurrentValue;
		$row['memo'] = $this->memo->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("id_usuario")) != "")
			$this->id_usuario->OldValue = $this->getKey("id_usuario"); // id_usuario
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
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
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

		if ($this->RowType == ROWTYPE_VIEW) { // View row

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
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// id_usuario
			$this->id_usuario->EditAttrs["class"] = "form-control";
			$this->id_usuario->EditCustomAttributes = "";
			$this->id_usuario->EditValue = HtmlEncode($this->id_usuario->CurrentValue);
			$this->id_usuario->PlaceHolder = RemoveHtml($this->id_usuario->caption());

			// nombre_usuario
			$this->nombre_usuario->EditAttrs["class"] = "form-control";
			$this->nombre_usuario->EditCustomAttributes = "";
			if (!$this->nombre_usuario->Raw)
				$this->nombre_usuario->CurrentValue = HtmlDecode($this->nombre_usuario->CurrentValue);
			$this->nombre_usuario->EditValue = HtmlEncode($this->nombre_usuario->CurrentValue);
			$this->nombre_usuario->PlaceHolder = RemoveHtml($this->nombre_usuario->caption());

			// clave
			$this->clave->EditAttrs["class"] = "form-control";
			$this->clave->EditCustomAttributes = "";
			if (!$this->clave->Raw)
				$this->clave->CurrentValue = HtmlDecode($this->clave->CurrentValue);
			$this->clave->EditValue = HtmlEncode($this->clave->CurrentValue);
			$this->clave->PlaceHolder = RemoveHtml($this->clave->caption());

			// nombres
			$this->nombres->EditAttrs["class"] = "form-control";
			$this->nombres->EditCustomAttributes = "";
			if (!$this->nombres->Raw)
				$this->nombres->CurrentValue = HtmlDecode($this->nombres->CurrentValue);
			$this->nombres->EditValue = HtmlEncode($this->nombres->CurrentValue);
			$this->nombres->PlaceHolder = RemoveHtml($this->nombres->caption());

			// apellidos
			$this->apellidos->EditAttrs["class"] = "form-control";
			$this->apellidos->EditCustomAttributes = "";
			if (!$this->apellidos->Raw)
				$this->apellidos->CurrentValue = HtmlDecode($this->apellidos->CurrentValue);
			$this->apellidos->EditValue = HtmlEncode($this->apellidos->CurrentValue);
			$this->apellidos->PlaceHolder = RemoveHtml($this->apellidos->caption());

			// cedula
			$this->cedula->EditAttrs["class"] = "form-control";
			$this->cedula->EditCustomAttributes = "";
			$this->cedula->EditValue = HtmlEncode($this->cedula->CurrentValue);
			$this->cedula->PlaceHolder = RemoveHtml($this->cedula->caption());

			// telefono
			$this->telefono->EditAttrs["class"] = "form-control";
			$this->telefono->EditCustomAttributes = "";
			if (!$this->telefono->Raw)
				$this->telefono->CurrentValue = HtmlDecode($this->telefono->CurrentValue);
			$this->telefono->EditValue = HtmlEncode($this->telefono->CurrentValue);
			$this->telefono->PlaceHolder = RemoveHtml($this->telefono->caption());

			// correo
			$this->correo->EditAttrs["class"] = "form-control";
			$this->correo->EditCustomAttributes = "";
			if (!$this->correo->Raw)
				$this->correo->CurrentValue = HtmlDecode($this->correo->CurrentValue);
			$this->correo->EditValue = HtmlEncode($this->correo->CurrentValue);
			$this->correo->PlaceHolder = RemoveHtml($this->correo->caption());

			// perfil_id
			$this->perfil_id->EditAttrs["class"] = "form-control";
			$this->perfil_id->EditCustomAttributes = "";
			$this->perfil_id->EditValue = HtmlEncode($this->perfil_id->CurrentValue);
			$this->perfil_id->PlaceHolder = RemoveHtml($this->perfil_id->caption());

			// memo
			$this->memo->EditAttrs["class"] = "form-control";
			$this->memo->EditCustomAttributes = "";
			$this->memo->EditValue = HtmlEncode($this->memo->CurrentValue);
			$this->memo->PlaceHolder = RemoveHtml($this->memo->caption());

			// Add refer script
			// id_usuario

			$this->id_usuario->LinkCustomAttributes = "";
			$this->id_usuario->HrefValue = "";

			// nombre_usuario
			$this->nombre_usuario->LinkCustomAttributes = "";
			$this->nombre_usuario->HrefValue = "";

			// clave
			$this->clave->LinkCustomAttributes = "";
			$this->clave->HrefValue = "";

			// nombres
			$this->nombres->LinkCustomAttributes = "";
			$this->nombres->HrefValue = "";

			// apellidos
			$this->apellidos->LinkCustomAttributes = "";
			$this->apellidos->HrefValue = "";

			// cedula
			$this->cedula->LinkCustomAttributes = "";
			$this->cedula->HrefValue = "";

			// telefono
			$this->telefono->LinkCustomAttributes = "";
			$this->telefono->HrefValue = "";

			// correo
			$this->correo->LinkCustomAttributes = "";
			$this->correo->HrefValue = "";

			// perfil_id
			$this->perfil_id->LinkCustomAttributes = "";
			$this->perfil_id->HrefValue = "";

			// memo
			$this->memo->LinkCustomAttributes = "";
			$this->memo->HrefValue = "";
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
		if ($this->id_usuario->Required) {
			if (!$this->id_usuario->IsDetailKey && $this->id_usuario->FormValue != NULL && $this->id_usuario->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id_usuario->caption(), $this->id_usuario->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->id_usuario->FormValue)) {
			AddMessage($FormError, $this->id_usuario->errorMessage());
		}
		if ($this->nombre_usuario->Required) {
			if (!$this->nombre_usuario->IsDetailKey && $this->nombre_usuario->FormValue != NULL && $this->nombre_usuario->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->nombre_usuario->caption(), $this->nombre_usuario->RequiredErrorMessage));
			}
		}
		if ($this->clave->Required) {
			if (!$this->clave->IsDetailKey && $this->clave->FormValue != NULL && $this->clave->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->clave->caption(), $this->clave->RequiredErrorMessage));
			}
		}
		if ($this->nombres->Required) {
			if (!$this->nombres->IsDetailKey && $this->nombres->FormValue != NULL && $this->nombres->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->nombres->caption(), $this->nombres->RequiredErrorMessage));
			}
		}
		if ($this->apellidos->Required) {
			if (!$this->apellidos->IsDetailKey && $this->apellidos->FormValue != NULL && $this->apellidos->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->apellidos->caption(), $this->apellidos->RequiredErrorMessage));
			}
		}
		if ($this->cedula->Required) {
			if (!$this->cedula->IsDetailKey && $this->cedula->FormValue != NULL && $this->cedula->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->cedula->caption(), $this->cedula->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->cedula->FormValue)) {
			AddMessage($FormError, $this->cedula->errorMessage());
		}
		if ($this->telefono->Required) {
			if (!$this->telefono->IsDetailKey && $this->telefono->FormValue != NULL && $this->telefono->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->telefono->caption(), $this->telefono->RequiredErrorMessage));
			}
		}
		if ($this->correo->Required) {
			if (!$this->correo->IsDetailKey && $this->correo->FormValue != NULL && $this->correo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->correo->caption(), $this->correo->RequiredErrorMessage));
			}
		}
		if ($this->perfil_id->Required) {
			if (!$this->perfil_id->IsDetailKey && $this->perfil_id->FormValue != NULL && $this->perfil_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->perfil_id->caption(), $this->perfil_id->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->perfil_id->FormValue)) {
			AddMessage($FormError, $this->perfil_id->errorMessage());
		}
		if ($this->memo->Required) {
			if (!$this->memo->IsDetailKey && $this->memo->FormValue != NULL && $this->memo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->memo->caption(), $this->memo->RequiredErrorMessage));
			}
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

		// id_usuario
		$this->id_usuario->setDbValueDef($rsnew, $this->id_usuario->CurrentValue, 0, FALSE);

		// nombre_usuario
		$this->nombre_usuario->setDbValueDef($rsnew, $this->nombre_usuario->CurrentValue, "", FALSE);

		// clave
		$this->clave->setDbValueDef($rsnew, $this->clave->CurrentValue, "", FALSE);

		// nombres
		$this->nombres->setDbValueDef($rsnew, $this->nombres->CurrentValue, "", FALSE);

		// apellidos
		$this->apellidos->setDbValueDef($rsnew, $this->apellidos->CurrentValue, "", FALSE);

		// cedula
		$this->cedula->setDbValueDef($rsnew, $this->cedula->CurrentValue, 0, FALSE);

		// telefono
		$this->telefono->setDbValueDef($rsnew, $this->telefono->CurrentValue, "", FALSE);

		// correo
		$this->correo->setDbValueDef($rsnew, $this->correo->CurrentValue, "", FALSE);

		// perfil_id
		$this->perfil_id->setDbValueDef($rsnew, $this->perfil_id->CurrentValue, 0, strval($this->perfil_id->CurrentValue) == "");

		// memo
		$this->memo->setDbValueDef($rsnew, $this->memo->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$rs = ($rsold) ? $rsold->fields : NULL;
		$insertRow = $this->Row_Inserting($rs, $rsnew);

		// Check if key value entered
		if ($insertRow && $this->ValidateKey && strval($rsnew['id_usuario']) == "") {
			$this->setFailureMessage($Language->phrase("InvalidKeyValue"));
			$insertRow = FALSE;
		}

		// Check for duplicate key
		if ($insertRow && $this->ValidateKey) {
			$filter = $this->getRecordFilter($rsnew);
			$rsChk = $this->loadRs($filter);
			if ($rsChk && !$rsChk->EOF) {
				$keyErrMsg = str_replace("%f", $filter, $Language->phrase("DupKey"));
				$this->setFailureMessage($keyErrMsg);
				$rsChk->close();
				$insertRow = FALSE;
			}
		}
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("usuarioslist.php"), "", $this->TableVar, TRUE);
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