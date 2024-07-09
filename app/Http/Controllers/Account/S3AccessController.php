<?php

namespace App\Http\Controllers\Account;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class S3AccessController extends Controller
{
	private $bucket;

	public function __construct()
	{
		$this->bucket = config('filesystems.disks.s3.bucket');
	}

	public function index()
	{
		return view('account.s3_policy.index');
	}

	public function grantAccess() {
		$result = Storage::disk('s3')->getDriver()->getAdapter()->getClient()->getBucketPolicy([
			'Bucket' => $this->bucket
		]);

		$policy = json_decode($result['Policy'], true);

		$statement = [
			'Sid' => 'GrantPublicReadAccess',
			'Effect' => 'Allow',
			'Principal' => '*',
			'Action' => ['s3:GetObject'],
			'Resource' => "arn:aws:s3:::{$this->bucket}/*"
		];

		$policy['Statement'][] = $statement;

		$putResult = Storage::disk('s3')->getDriver()->getAdapter()->getClient()->putBucketPolicy([
			'Bucket' => $this->bucket,
			'Policy' => json_encode($policy),
		]);

		if ($putResult['@metadata']['statusCode'] !== 200) {
			throw new \Exception('Failed to update bucket policy.');
		}

		return redirect()->back()->with('message', 'Public access granted successfully');
	}


	public function removeAccess() {
		try {
			$result = Storage::disk('s3')->getDriver()->getAdapter()->getClient()->getBucketPolicy([
				'Bucket' => $this->bucket
			]);

			$policy = json_decode($result['Policy'], true);

			// $filteredStatements = array_filter($policy['Statement'], function ($statement) {
			// 	dd($statement['Sid']);
			// 	return !isset($statement['Sid']) || $statement['Sid'] !== 'Stmt1694783588936';
			// });
			// $filteredStatements = array_filter($policy['Statement'], function ($statement) {
			// 	return !isset($statement['Sid']) || $statement['Sid'] !== 'Stmt1694783588936';
			// });
			$filteredStatements = array_filter($policy['Statement'], function ($statement) {
			    return $statement['Sid'] !== 'Stmt1694783588936';
			});
			// dd($policy['Statement']);
			dd($filteredStatements);
			if (empty($filteredStatements)) {
				return redirect()->back()->with('error', 'Failed to remove public access: No matching policy found.');
			}

			$policy['Statement'] = array_values($filteredStatements);

			$putResult = Storage::disk('s3')->getDriver()->getAdapter()->getClient()->putBucketPolicy([
				'Bucket' => $this->bucket,
				'Policy' => json_encode($policy),
			]);

			if ($putResult['@metadata']['statusCode'] !== 200) {
				throw new \Exception('Failed to update bucket policy.');
			}

			return redirect()->back()->with('message', 'Public access removed successfully');
		} catch (\Exception $e) {
			return redirect()->back()->with('error', 'Failed to remove public access');
		}
	}
}