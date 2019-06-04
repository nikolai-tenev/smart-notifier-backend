package com.digidworks.smartnotifier.controller.rest;

import com.digidworks.smartnotifier.dto.JobboardPost;
import com.rometools.rome.feed.synd.SyndEntry;
import com.rometools.rome.feed.synd.SyndFeed;
import com.rometools.rome.io.FeedException;
import com.rometools.rome.io.SyndFeedInput;
import com.rometools.rome.io.XmlReader;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;
import org.springframework.web.servlet.HandlerMapping;

import javax.servlet.http.HttpServletRequest;
import java.io.IOException;
import java.net.URL;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

@RestController
@RequestMapping("/api/feeds/rss")
public class RssProxy {

	@GetMapping("/upwork/**")
	public List<JobboardPost> loadUpworkFeed(HttpServletRequest request) throws IOException, FeedException {
		String query = request.getQueryString();
		return fetchRssFeed("https://www.upwork.com/ab/feed/jobs/rss?" + query);
	}

	@GetMapping("/guru/**")
	public List<JobboardPost> loadGuruFeed(HttpServletRequest request) throws IOException, FeedException {
		String requestedUri = (String) request.getAttribute(HandlerMapping.PATH_WITHIN_HANDLER_MAPPING_ATTRIBUTE);
		return fetchRssFeed("https://www.guru.com/rss/jobs/" + requestedUri.replace("/api/feeds/rss/guru/jobs/", ""));
	}

	private List<JobboardPost> fetchRssFeed(String url) throws IOException, FeedException {
		Map<String, String> headers = new HashMap<>();


		headers.put("accept", "text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8");
		headers.put("accept-encoding", "gzip, deflate, br");
		headers.put("accept-language", "en-GB,en-US;q=0.9,en;q=0.8,bg;q=0.7");
		headers.put("dnt", "1");
		headers.put("upgrade-insecure-requests", "1");
		headers.put("user-agent", "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36");

		if (url.toLowerCase().contains("guru.com")) {
			headers.put("cache-control", "max-age=0");
			headers.put("cookie", "visid_incap_1227176=5FO9AvXKQ7KEjNc94YzCVwtZflwAAAAAQUIPAAAAAADcimQiaqb7gKj9OIa3EIJ4; incap_ses_728_1227176=WI3EAhNxnnSPaJF86mAaCgtZflwAAAAARvd+BRbhbsxgDCrCZJmM3A==; ___utmvc=rvTb0MBACtpnh5ZXixzjs5qpLRDJ2O56Du9K9Yh/WN0MiMboiucZA6ksKABKm0BRU5pRqdHN6/xsHM4qwD0ZXlHg1Zt1Xv3tfhak2zoC2Jcb8yVJF1GxjU/A+22zLM1mynnViiXEkmFQlTXAegd/OiZwVpyM25iFQShdVxHSNOpXA1dg3rV8HIx2cgKQzfYmM6uy7zTkm8KeVpCVPA2rRmywO/kKAGVav4Ohwro2NuAtqr7+uCiUzyH1h6QrgUrBpglvpgLUYI9B/eOvEgOkpOQF5VCHGIGXIOvqNwxDDJMoUfPpfeK7rAEi6tvJNVfaTVupwz9qLDT1QjO0myQ1AegQKt3VyJGlSF+fCYYODVRAmANVjJ+seQlw5NTSgv9qZSfQ6qfJGIuCQM9td6K/UaCHE9ZK7TLiCcaSzhSM2vED1I8K6HEQoeVl/VSo0yzG6pBUsYTfCzfhu2LJxm5IKOCsHEg8jSNRBWTOaueCtNzIAjt4bMRGnUvQxQo2M9gQrhx6ngZH+njJqasP5+brVLV+eHwu1Sxp3CuJ6rTaQELKHUaK+jmMt535zdcIukrJHUChPuzqmu9TpvcFepNvELIDjpwvSo/UpiiCQgrtceFWW8q3hKSi3YTayFy//n0NXA+Qb9PWz8MQ0eYiQJAtOFU9G05O9zL+tZ4NtLF4XXPxqc1rtmlPZRFayShK+oTU+7I1nBycegW4SR0xHtkkTYEAIW7jRqV4LKe/blsM1qmcoL4Q8K/bvTqe90AmartD46vdF4SzoDlnxUCcwX7LlikKHLOaPAa2+4/WbiNTJ4tLQ1ZrmohDFR1LK7rhcxyq2eFAbX9C96iKVzxVBFX1IdBWpoa5DMnjY/d/C5ze8liBEGwA24YYR2cTK5kFn2T4HpBIyHvASV7nqMuQQZMOmm1tDaopvZM2WPZr7lkxYu8jPX66KAD9k4c+Uvn/96WViEpV5vuHynN/UTQJIZrM7vKiYlOk1JoqX40vllnGkChZ+mFUsiM4izxMZLDPTfosy6CiZm4tEa/gVjvNNPpSondBgPltMzMmvWO7T/8rTnAL7HvldPay1NaAa32utvEc7i+PJ8GWkVkw6l3dnOnU04boVUFdBLeHWAmQWZhFRCXbo/6I1JQJ8CBVyUoCuL6UZQ96bp0/SvwrK5AgysDcyq+H6LcsPJJkcLr1L3tqrixkaWdlc3Q9ODc4MTEscz03Y2EwODA2ODg1NzlhYzg4NjVhYTdhN2FhNDY5Nzk4MWEzOGU3YzgyNjc2YTlkODVhNTdkODFhN2E4ODg4ZDliODY4Mzg2N2I5OGFmNmU2ZQ==");
		}


		XmlReader reader = new XmlReader(new URL(url));
		SyndFeed feed = new SyndFeedInput().build(reader);

		List<JobboardPost> result = new ArrayList<>();

		for (SyndEntry entry : feed.getEntries()) {
			String title = entry.getTitle();
			if (title.toLowerCase().contains("do not apply")) {
				continue;
			}

			title = title.replace(" - Upwork", "");

			JobboardPost jobboardPost = new JobboardPost();
			jobboardPost.setGuid(entry.getUri());
			jobboardPost.setTitle(title);
			jobboardPost.setLink(entry.getLink());
			jobboardPost.setDescription(entry.getDescription().getValue());
			jobboardPost.setPubDate(entry.getPublishedDate().getTime());

			result.add(jobboardPost);
		}

		return result;
	}
}
