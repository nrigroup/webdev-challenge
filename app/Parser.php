<?php

namespace App;

use Box\Spout\Common\Exception\IOException;
use Box\Spout\Common\Exception\UnsupportedTypeException;
use Box\Spout\Reader\Exception\ReaderNotOpenedException;
use Carbon\Carbon;
use Rap2hpoutre\FastExcel\FastExcel;

/**
 * Class Parser
 *
 * Handle Uploaded CSV file
 *
 * @package App
 */
class Parser
{
    private $dateFormat = 'Y-m-d';
    private $file;
    private $uid;
    /**
     * CSV parsed Items
     *
     * @var array
     */
    private $collection = [];

    /**
     * Database table friendly Items
     *
     * @var array
     */
    private $items = [];

    /**
     * Parser constructor.
     *
     * @param      $file
     * @param int  $uid
     * @param null $dateFormat
     */
    public function __construct($file, $uid = 0, $dateFormat = NULL)
    {
        $this->file = $file;

        $this->uid = $uid;

        if (!is_null($dateFormat)) {
            $this->dateFormat = $dateFormat;
        }

        $this->handle();
    }

    /**
     * Handle File
     */
    public function handle()
    {
        if (!$this->file) {
            return;
        }

        try {
            $this->setCollection();
        } catch (IOException $e) {
        } catch (UnsupportedTypeException $e) {
        } catch (ReaderNotOpenedException $e) {
        }
    }

    /**
     * Set Collection
     *
     * Parse CSV and set the parsed array into collection
     *
     * @throws IOException
     * @throws ReaderNotOpenedException
     * @throws UnsupportedTypeException
     */
    private function setCollection()
    {
        try {
            $this->collection = (new FastExcel)->import($this->file);
        } catch (IOException $e) {
            throw new IOException(sprintf('Unable to process %s', $e->getMessage()));
        } catch (UnsupportedTypeException $e) {
            throw new UnsupportedTypeException(sprintf('Unsupported file type %s', $this->file));
        } catch (ReaderNotOpenedException $e) {
            throw new ReaderNotOpenedException(sprintf('Unable to open %s', $this->file));
        }
    }

    /**
     * Parser
     *
     * Parse the uploaded file
     *
     * @return array|void
     */
    public function parse()
    {
        // Iterate through collection
        if ($this->collection AND count($this->collection) > 0) {
            foreach ($this->collection as $item) {

                // Database table friendly iterated item
                $this->iterateItem($item);
            }

            return $this->items;
        }

        return [];
    }

    /**
     * Iterate item
     *
     *
     * @param $item
     *
     * @return void
     */
    private function iterateItem($item)
    {
        if (is_array($item)) {
            $t = Carbon::now();

            $this->items[] = [
                'uid'        => $this->uid,
                'date'       => $this->formatDate($item['date']),
                'category'   => $item['category'],
                'title'      => $item['lot title'],
                'location'   => $item['lot location'],
                'condition'  => $item['lot condition'],
                'pre_tax'    => doubleval($item['pre-tax amount']),
                'tax_name'   => $item['tax name'],
                'tax_amount' => doubleval($item['tax amount']),
                'created_at' => $t,
                'updated_at' => $t,
            ];
        }
    }

    /**
     * Format Date
     *
     * Format date to match
     * with database Date format
     *
     * @param $date
     *
     * @return string
     */
    private function formatDate($date)
    {
        if (strlen($date) > 0) {
            return Carbon::parse($date)->format($this->dateFormat);
        }

        return Carbon::now()->format($this->dateFormat);
    }

    /**
     * Get Extracted Collection
     */
    public function getCollection()
    {
        if (!$this->collection) {
            return [];
        }

        return $this->collection;
    }
}
