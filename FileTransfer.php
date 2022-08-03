<?php

class FileTransfer
{

	/**
	 * Массив путей до директорий
	 * @var string[]
	 */
	private static $dirs = ['/directory1/', '/directory2/'];

	/**
	 * Метод переносит файлы из первой директории в следующую в порядке массива.
	 * Файлы из последней директории переносятся в первую.
	 * @return void
	 */
	public static function move()
	{
		$files = [];

		foreach(self::$dirs as $dir){
			$files[$dir] = self::getFiles(__DIR__.$dir);
		}

		foreach(self::$dirs as $i => $dir){
			$nextDir = self::$dirs[$i + 1] ?? self::$dirs[0];

			foreach($files[$dir] as $file){
				rename(__DIR__.$dir.$file, __DIR__.$nextDir.$file);
			}
		}
	}

	/**
	 * Возвращает список файлов в директории
	 * @param string $dir Путь до директории
	 * @return array|false
	 */
	public static function getFiles(string $dir)
	{
		return array_diff(scandir($dir), ['.', '..']);
	}

}