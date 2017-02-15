<?php
class ExceptionHook
{
	public function SetExceptionHandler()
	{
		set_exception_handler(array($this, 'HandleExceptions'));
	}
	public function HandleExceptions($exception)
	{
		$msg ='Exception type is: \''.get_class($exception)
		.'\' Full Message: '.$exception->getMessage()
		.' File Name : '.$exception->getFile()
		.' at Line : '.$exception->getLine();
		$msg .="\r\n Backtrace \r\n";
		$msg .=$exception->getTraceAsString();
		log_message('error', $msg, TRUE);
		//echo "<script>alert('Some technical errors occured');</script>";

		//mail();
	} 
}

